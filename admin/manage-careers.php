<?php
require_once 'includes/header.php';

// --- FORM HANDLING LOGIC ---

$message = '';
$error = '';
$edit_career = null;

// Handle DELETE request
if (isset($_GET['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_GET['delete']);
    $delete_query = "DELETE FROM careers WHERE id = '$id_to_delete'";
    if (mysqli_query($conn, $delete_query)) {
        $message = "Career deleted successfully!";
    } else {
        $error = "Error deleting career: " . mysqli_error($conn);
    }
}

// Handle POST request (Add or Update)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $roadmap_link = mysqli_real_escape_string($conn, $_POST['roadmap_link']);
    $career_id = isset($_POST['career_id']) ? mysqli_real_escape_string($conn, $_POST['career_id']) : null;

    // Check for empty fields
    if (empty($title) || empty($description) || empty($category)) {
        $error = "Title, Description, and Category are required fields.";
    } else {
        if ($career_id) {
            // Update existing career
            $query = "UPDATE careers SET title='$title', description='$description', category='$category', roadmap_link='$roadmap_link' WHERE id='$career_id'";
            if (mysqli_query($conn, $query)) {
                $message = "Career updated successfully!";
            } else {
                $error = "Error updating career: " . mysqli_error($conn);
            }
        } else {
            // Insert new career
            $query = "INSERT INTO careers (title, description, category, roadmap_link) VALUES ('$title', '$description', '$category', '$roadmap_link')";
            if (mysqli_query($conn, $query)) {
                $message = "Career added successfully!";
            } else {
                $error = "Error adding career: " . mysqli_error($conn);
            }
        }
    }
}

// Handle EDIT request (fetch data for the form)
if (isset($_GET['edit'])) {
    $id_to_edit = mysqli_real_escape_string($conn, $_GET['edit']);
    $edit_query = "SELECT * FROM careers WHERE id = '$id_to_edit'";
    $edit_result = mysqli_query($conn, $edit_query);
    $edit_career = mysqli_fetch_assoc($edit_result);
}

// Fetch all careers to display in the table
$careers_query = "SELECT * FROM careers ORDER BY title ASC";
$careers_result = mysqli_query($conn, $careers_query);
?>

<h1 class="text-4xl font-bold mb-8">Manage Careers</h1>

<!-- Add/Edit Form Card -->
<div class="content-card mb-8">
    <h2 class="text-2xl font-bold mb-4"><?php echo $edit_career ? 'Edit Career' : 'Add New Career'; ?></h2>
    
    <!-- Display Success/Error Messages -->
    <?php if ($message): ?><div class="bg-green-500/20 text-green-300 p-3 rounded-lg mb-4"><?php echo $message; ?></div><?php endif; ?>
    <?php if ($error): ?><div class="bg-red-500/20 text-red-300 p-3 rounded-lg mb-4"><?php echo $error; ?></div><?php endif; ?>

    <form action="manage-careers.php" method="POST">
        <?php if ($edit_career): ?>
            <input type="hidden" name="career_id" value="<?php echo htmlspecialchars($edit_career['id']); ?>">
        <?php endif; ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-300">Career Title</label>
                <input type="text" name="title" id="title" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?php echo htmlspecialchars($edit_career['title'] ?? ''); ?>" required>
            </div>
            <div class="md:col-span-2">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-300">Description</label>
                <textarea name="description" id="description" rows="4" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required><?php echo htmlspecialchars($edit_career['description'] ?? ''); ?></textarea>
            </div>
            <div>
                <label for="category" class="block mb-2 text-sm font-medium text-gray-300">Category</label>
                <input type="text" name="category" id="category" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?php echo htmlspecialchars($edit_career['category'] ?? ''); ?>" required>
            </div>
            <div>
                <label for="roadmap_link" class="block mb-2 text-sm font-medium text-gray-300">Roadmap Link (Optional)</label>
                <input type="url" name="roadmap_link" id="roadmap_link" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?php echo htmlspecialchars($edit_career['roadmap_link'] ?? ''); ?>">
            </div>
        </div>
        <div class="mt-6 flex items-center gap-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                <?php echo $edit_career ? 'Update Career' : 'Save Career'; ?>
            </button>
            <?php if ($edit_career): ?>
                <a href="manage-careers.php" class="text-gray-400 hover:text-white">Cancel Edit</a>
            <?php endif; ?>
        </div>
    </form>
</div>

<!-- Careers List Card -->
<div class="content-card overflow-x-auto">
    <h2 class="text-2xl font-bold mb-4">Existing Careers</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($careers_result) > 0): ?>
                <?php while ($career = mysqli_fetch_assoc($careers_result)): ?>
                    <tr>
                        <td class="font-semibold"><?php echo htmlspecialchars($career['title']); ?></td>
                        <td><span class="bg-gray-600 text-gray-200 text-xs font-medium px-2.5 py-1 rounded-full"><?php echo htmlspecialchars($career['category']); ?></span></td>
                        <td class="flex gap-4">
                            <a href="manage-careers.php?edit=<?php echo $career['id']; ?>" class="text-blue-400 hover:text-blue-300" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                            <a href="manage-careers.php?delete=<?php echo $career['id']; ?>" onclick="return confirm('Are you sure you want to delete this career?');" class="text-red-500 hover:text-red-400" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="3" class="text-center py-8">No careers found. Add one above to get started.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
require_once 'includes/footer.php';
?>
