<?php
	require_once '../core/db.php';
	if(!login())
	{
		header("location:login.php");
		exit();
	}

    if(user('status') == 0){
        set_flash("Kindly pay your school fees to continue!","warning");
        header("location:index.php");
        exit();
    }

    if(!isset($_GET['semester']) || (!isset($_GET['session']))){
        header("location:index.php");
        exit();
    }


//load fpdf
    require_once "../lib/fpdf/fpdf.php";

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('../img/logo.png',10,10,75);
        $this->Ln(38);

        $this->SetFont('Arial','B',11);
        $this->cell(195,9,strtoupper('Semester result'),1,0,'C');
        $this->Ln(20);


        $this->cell(70,9,'Full Name',0,0,'L');
        $this->cell(120,9,strtoupper(user('name')),0,0,'L');
        $this->Image('img/students/'.user('passport'),154,60,20);
        $this->Ln(10);

        $this->cell(70,9,'Session',0,0,'L');
        $this->cell(11,9,$_GET['session'],0,0,'L');

        $this->Ln(10);

        $this->cell(70,9,'Semester',0,0,'L');
        $this->cell(20,9,$_GET['semester'],0,0,'L');
        $this->Ln(10);

        $this->cell(70,9,'Department',0,0,'L');
        $this->cell(60,9,strtoupper(user('department')),0,0,'L');
        $this->cell(30,9,'Level',0,0,'L');
        $this->cell(30,9,user('level'),0,0,'L');
        $this->Ln(20);

        //$this->cell(195,2,'',1,0,'L');
        $this->Ln(2);
        $this->cell(30,9,'Course Code',1,0,'C');
        $this->cell(80,9,'Course Title',1,0,'C');
        $this->cell(20,9,'Unit',1,0,'C');
        $this->cell(20,9,'Score',1,0,'C');
        $this->cell(20,9,'Point',1,0,'C');
        $this->cell(20,9,'Grade',1,0,'C');
        $this->Ln(9);
    }

    function Footer()
    {
        $this->Ln(12);
        $this->SetFont('Arial','B',11);
        $this->cell(195,9,strtoupper('Federal Polytechnic, Ede'),1,0);
        $this->Ln(9);
        $this->cell(195,9,"Date Printed: ".date("d/m/Y h:i a"),0,0);
        $this->Ln(8);

    }
}



$pdf = new PDF('P','mm','A4');
$pdf->AddPage();

$matric = user("matric");
$session = $_GET['session'];
$semester = $_GET['semester'];
$stmt = $db->query("SELECT * FROM result WHERE matric = '$matric' AND session = '$session' AND semester = '$semester'");

$p = 0;
$u = 0;
while ($rs = $stmt->fetch(PDO::FETCH_ASSOC))
{
    $pdf->cell(30,10,ucfirst(course($rs['course_id'],"code")),1,0,'L');
    $pdf->cell(80,10,ucwords(course($rs['course_id'],"title")),1,0,'L');
    $pdf->cell(20,10,course($rs['course_id'],"unit"),1,0,'C');
    $pdf->cell(20,10,$rs['score'],1,0,'C');
    $pp = points($rs['score']) * course($rs['course_id'],"unit");
    $u +=  course($rs['course_id'],"unit");
    $p += $pp;
    $pdf->cell(20,10,"$pp",1,0,'L');
    $pdf->cell(20,10,grade($rs['score']),1,0,'L');
    $pdf->Ln(10);
}

$pdf->cell(110,9,'Total',1,0,'C');
$pdf->cell(20,9,"$u",1,0,'C');
$pdf->cell(20,9,'',1,0,'C');
$pdf->cell(20,9,"$p",1,0,'C');
$pdf->cell(20,9,'',1,0,'C');

$pdf->Ln(15);
$gpa = $p / $u;
$gpa = substr($gpa,0,5);


$pdf->cell(180,9,'Grade Point Average (GPA): '.$gpa,0,0,'L');
$pdf->Ln(15);



//$pdf->Image('../img/logo.png',10,60,189);
$pdf->SetFont('Arial','B',11);
$pdf->output();