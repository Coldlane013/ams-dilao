<?php
require '../../vendor/autoload.php';
require_once('../../init/model/config/connection2.php');



	
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
/*$sheet->setCellValue('Name','Time In', 'Time Out', 'Log Date', 'Status');*/ ///arrays
$writer =new Xlsx($spreadsheet);
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();
$activeSheet->setCellValue('A1', 'Name');
$activeSheet->setCellValue('B1', 'Time In');
$activeSheet->setCellValue('C1', 'Time Out');
$activeSheet->setCellValue('D1', 'Log Date');
$activeSheet->setCellValue('E1', 'Status');



	if(ISSET($_POST['export']) ){
		$date1 = date("Y-m-d", strtotime($_POST['date1']));
		$date2 = date("Y-m-d", strtotime($_POST['date2']));


		$stmt = $conn->prepare("SELECT * FROM tbl_attendance a INNER JOIN tbl_employee b ON a.employee_qrcode = b.qr_code WHERE a.logdate BETWEEN ? AND ? ORDER BY a.attendance_id ASC");
		$stmt->bind_param("ss", $date1, $date2);
		$stmt->execute();
		$result = $stmt->get_result();


		if ($result->num_rows > 0) {
		// Output each row of the data
		$i = 2; 
		while ($row = $result->fetch_assoc()) {
			$activeSheet->setCellValue('A'.$i, $row['last_name'] . ', ' . $row['first_name']);
			$activeSheet->setCellValue('B' . $i, date('h:i:A', strtotime($row['time_in'])));
			$activeSheet->setCellValue('C' . $i, date('h:i:A', strtotime($row['time_out'])));
			$activeSheet->setCellValue('D' . $i, date("M d, Y", strtotime($row['logdate'])));
			$activeSheet->setCellValue('E' . $i, $row['time_stat']);
			$i++;
		}
	}
	else {
		$output.= 'No records found...' . "\n";
	}

	$filename = 'attendance_report_' . date('m-d-Y').'.xls';

	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename=' . $filename);
	header('Cache-Control: max-age=0');
	$writer->save('php://output');
	
}
