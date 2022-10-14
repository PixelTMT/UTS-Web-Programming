<?php
require_once __DIR__.'/vendor/autoload.php';
require_once 'db.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

function save_Data(){
    global $db;
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getSheet($spreadsheet->getFirstSheetIndex());
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue("A1", "ID");
    $sheet->setCellValue("B1", "Name");
    $sheet->setCellValue("C1", "Username");
    $sheet->setCellValue("D1", "Email");
    $sheet->setCellValue("E1", "Jumlah Like");
    $sheet->setCellValue("F1", "Jumlah Comment");
    $sheet->setCellValue("G1", "Jumlah Postingan");

    $sql = "select * from user";
    $hasil = $db->query($sql);
    for($i = 2; $row = $hasil->fetch(PDO::FETCH_ASSOC); $i++){
        $sheet->setCellValue("A{$i}", $row['id']);
        $sheet->setCellValue("B{$i}", $row['name']); //name
        $sheet->setCellValue("C{$i}", $row['username']); //username
        $sheet->setCellValue("D{$i}", $row['email']); //email

        $sql2 = "SELECT SUM(like_bool) as total from likes where post_id = any(select id from post where user_id = ?)";
        $stmt = $db->prepare($sql2);
        $stmt->execute([$row['id']]);
        $row2 = $stmt->fetch(PDO::FETCH_ASSOC);
        $sheet->setCellValue("E{$i}", NoTNull($row2['total'])); // Total like

        $sql2 = "SELECT count(*) as total from comment where user_id = ?";
        $stmt = $db->prepare($sql2);
        $stmt->execute([$row['id']]);
        $row2 = $stmt->fetch(PDO::FETCH_ASSOC);
        $sheet->setCellValue("F{$i}", NoTNull($row2['total'])); // total comment

        $sql2 = "SELECT count(*) as total from post where user_id = ?";
        $stmt = $db->prepare($sql2);
        $stmt->execute([$row['id']]);
        $row2 = $stmt->fetch(PDO::FETCH_ASSOC);
        $sheet->setCellValue("G{$i}", NoTNull($row2['total'])); //total post
    }

    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
    $sheet->getColumnDimension('G')->setAutoSize(true);

    $writer = new Xlsx($spreadsheet);
    $writer->save('SpacelyData.xlsx');
    header("Location: SpacelyData.xlsx");
}
function NoTNull($dat){
    if(intval($dat)){
        return $dat;
    }
    return 0;
}