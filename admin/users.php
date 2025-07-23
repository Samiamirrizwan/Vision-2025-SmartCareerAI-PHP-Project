<?php
require_once 'includes/header.php';

$message = '';
$error = '';

// --- Handle DELETE request ---
if (isset($_GET['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_GET['delete']);
    // You should also delete related data (test sessions, results, etc.) or set FK to ON DELETE CASCADE
    $delete_query = "DELETE FROM users WHERE id = '$id_to_delete'";
    if (mysqli_query($conn, $delete_query)) {
        $message = "User and all associated data deleted successfully!";
    } else {
        $error = "Error deleting user: " . mysqli_error($conn);
    }
}

// --- Handle POST request for UPDATE ---
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    if (empty($name) || empty($email)) {
        $error = "Name and Email cannot be empty.";
    } else {
        $update_query = "UPDATE users SET name='$name', email='$email' WHERE id='$user_id'";
        if (mysqli_query($conn, $update_query)) {
            $message = "User updated successfully!";
        } else {
            $error = "Error updating user: " . mysqli_error($conn);
        }
    }
}

// Fetch all users from the database
$query = "SELECT id, name, email, created_at FROM users ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<h1 class="text-4xl font-bold mb-2 text-white">Manage Users</h1>
<p class="text-gray-400 mb-8">Edit, update, and remove user accounts.</p>

<!-- Display Success/Error Messages -->
<?php if ($message): ?><div class="bg-green-500/20 text-green-300 p-3 rounded-lg mb-4"><?php echo $message; ?></div><?php endif; ?>
<?php if ($error): ?><div class="bg-red-500/20 text-red-300 p-3 rounded-lg mb-4"><?php echo $error; ?></div><?php endif; ?>

<div class="content-card overflow-x-auto">
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date Joined</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($user = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
                        <td class="text-right">
                            <button onclick="openEditModal(<?php echo htmlspecialchars(json_encode($user)); ?>)" class="text-blue-400 hover:text-blue-300 transition mr-4" title="Edit User"><i class="fas fa-pencil-alt"></i></button>
                            <button onclick="openDeleteModal(<?php echo $user['id']; ?>, '<?php echo addslashes(htmlspecialchars($user['name'])); ?>')" class="text-red-500 hover:text-red-400 transition" title="Delete User"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center py-8">No users found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
function openEditModal(user) {
    const modalHTML = `
        <h2 class="text-2xl font-bold mb-4 text-white">Edit User</h2>
        <form action="users.php" method="POST">
            <input type="hidden" name="user_id" value="${user.id}">
            <div class="mb-4">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Name</label>
                <input type="text" name="name" id="name" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg w-full p-2.5" value="${user.name}" required>
            </div>
            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-300">Email</label>
                <input type="email" name="email" id="email" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg w-full p-2.5" value="${user.email}" required>
            </div>
            <div class="flex justify-end gap-4">
                <button type="button" onclick="hideModal()" class="py-2 px-5 bg-gray-600 hover:bg-gray-500 rounded-lg transition">Cancel</button>
                <button type="submit" name="update_user" class="py-2 px-5 bg-blue-600 hover:bg-blue-700 rounded-lg transition">Update User</button>
            </div>
        </form>
    `;
    showModal(modalHTML);
}

function openDeleteModal(userId, userName) {
    const modalHTML = `
        <h2 class="text-2xl font-bold mb-2 text-white">Confirm Deletion</h2>
        <p class="text-gray-400 mb-6">Are you sure you want to permanently delete the user <strong class="text-white">${userName}</strong>? This action cannot be undone.</p>
        <div class="flex justify-end gap-4">
            <button type="button" onclick="hideModal()" class="py-2 px-5 bg-gray-600 hover:bg-gray-500 rounded-lg transition">Cancel</button>
            <a href="users.php?delete=${userId}" class="py-2 px-5 bg-red-600 hover:bg-red-700 rounded-lg transition text-white no-underline">Yes, Delete</a>
        </div>
    `;
    showModal(modalHTML);
}
</script>

<?php
require_once 'includes/footer.php';
?>
