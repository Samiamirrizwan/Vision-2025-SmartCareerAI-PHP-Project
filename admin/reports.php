<?php
require_once 'includes/header.php';

$report_data = [];
$is_filtered = false;
$date_from = $_GET['date_from'] ?? '';
$date_to = $_GET['date_to'] ?? '';

// --- REPORT GENERATION LOGIC ---
if (isset($_GET['filter']) || isset($_GET['export'])) {
    if (!empty($date_from) && !empty($date_to)) {
        $is_filtered = true;
        
        $query = "SELECT u.name, u.email, r.score, r.category_scores, r.generated_at 
                  FROM results r
                  JOIN users u ON r.user_id = u.id
                  WHERE r.generated_at BETWEEN ? AND ?
                  ORDER BY r.generated_at DESC";
        
        $stmt = mysqli_prepare($conn, $query);
        $start_date = $date_from . " 00:00:00";
        $end_date = $date_to . " 23:59:59";
        mysqli_stmt_bind_param($stmt, "ss", $start_date, $end_date);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $report_data[] = $row;
            }
        }
        mysqli_stmt_close($stmt);
    }
}

// --- EXPORT LOGIC ---
if (isset($_GET['export']) && $is_filtered) {
    $format = $_GET['export'];
    if (!file_exists('reports')) {
        mkdir('reports', 0777, true); // Ensure the reports directory exists
    }
    
    $filename = "reports/report_" . date('Y-m-d_H-i-s');

    if ($format == 'csv') {
        $filename .= ".csv";
        $fp = fopen($filename, 'w');
        // Add headers
        fputcsv($fp, ['User Name', 'Email', 'Overall Score (%)', 'Category Scores', 'Date']);
        // Add data
        foreach ($report_data as $row) {
            $scores = json_decode($row['category_scores'], true);
            $score_string = '';
            if(is_array($scores)) {
                foreach($scores as $cat => $score) $score_string .= "$cat: $score%; ";
            }
            fputcsv($fp, [$row['name'], $row['email'], $row['score'], rtrim($score_string, '; '), $row['generated_at']]);
        }
        fclose($fp);
    }
    // PDF generation would require a library like FPDF or TCPDF.
    // This is a placeholder for CSV.

    // Force download the created file
    if(file_exists($filename)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        readfile($filename);
        exit;
    }
}
?>

<h1 class="text-4xl font-bold mb-2 text-white">Advanced Reports</h1>
<p class="text-gray-400 mb-8">Filter and export user test results.</p>

<div class="content-card mb-8">
    <h2 class="text-2xl font-bold mb-4">Filter & Export</h2>
    <form action="reports.php" method="GET">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 items-end">
            <div>
                <label for="date_from" class="block mb-2 text-sm font-medium text-gray-300">From Date</label>
                <input type="date" name="date_from" id="date_from" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg w-full p-2.5" value="<?php echo htmlspecialchars($date_from); ?>" required>
            </div>
            <div>
                <label for="date_to" class="block mb-2 text-sm font-medium text-gray-300">To Date</label>
                <input type="date" name="date_to" id="date_to" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg w-full p-2.5" value="<?php echo htmlspecialchars($date_to); ?>" required>
            </div>
            <div class="flex gap-4">
                <button type="submit" name="filter" value="true" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-lg transition">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
            </div>
             <div class="flex gap-4">
                <button type="submit" name="export" value="csv" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2.5 px-5 rounded-lg transition <?php if(!$is_filtered) echo 'opacity-50 cursor-not-allowed'; ?>" <?php if(!$is_filtered) echo 'disabled'; ?>>
                    <i class="fas fa-file-csv mr-2"></i>Export CSV
                </button>
            </div>
        </div>
    </form>
</div>

<?php if ($is_filtered): ?>
<div class="content-card overflow-x-auto">
    <h2 class="text-2xl font-bold mb-4">Report Results (<?php echo count($report_data); ?> records)</h2>
    <?php if (!empty($report_data)): ?>
    <table class="data-table">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Email</th>
                <th>Score</th>
                <th>Category Scores</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($report_data as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><span class="font-bold text-lg"><?php echo htmlspecialchars($row['score']); ?>%</span></td>
                <td>
                    <?php 
                    $category_scores = json_decode($row['category_scores'], true);
                    if (is_array($category_scores)) {
                        foreach($category_scores as $category => $score) {
                            echo '<span class="bg-gray-600 text-gray-200 text-xs font-medium mr-2 px-2.5 py-1 rounded-full">' . htmlspecialchars($category) . ': ' . htmlspecialchars($score) . '%</span>';
                        }
                    }
                    ?>
                </td>
                <td><?php echo date('M d, Y H:i', strtotime($row['generated_at'])); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p class="text-center text-gray-400 py-8">No test results found for the selected date range.</p>
    <?php endif; ?>
</div>
<?php else: ?>
    <div class="text-center text-gray-500 py-10 content-card">
        <i class="fas fa-info-circle text-4xl mb-4 text-blue-400"></i>
        <p>Please select a date range and click "Filter" to view data.</p>
    </div>
<?php endif; ?>

<?php
require_once 'includes/footer.php';
?>
