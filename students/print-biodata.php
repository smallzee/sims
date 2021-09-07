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


//load fpdf
    require_once "../lib/fpdf/fpdf.php";

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('../img/logo.png',10,10,75);
        $this->Ln(34);

        $this->SetFont('Arial','B',10);
        $this->cell(195,9,strtoupper('biodata'),1,0,'C');
        $this->Ln(15);

        $this->cell(60,9,'Matric Number',0,0,'L');
        $this->cell(120,9,strtoupper(user('matric')),0,0,'L');
        $this->Image('img/students/'.user('passport'),154,60,20);
        $this->Ln(8);

        $this->cell(60,9,'Full Name',0,0,'L');
        $this->cell(120,9, strtoupper(user('name')),0,0,'L');
        $this->Ln(8);

        $this->cell(60,9,'Session',0,0,'L');
        $this->cell(11,9,settings("session"),0,0,'L');
        //$this->cell(12,9,date('Y')+1,0,0,'L');
        $this->Ln(8);

        $this->cell(60,9,'Semester',0,0,'L');
        $this->cell(11,9,settings("semester"),0,0,'L');
        $this->Ln(8);

        $this->cell(60,9,'School',0,0,'L');
        $this->cell(50,9,user('faculty'),0,0,'L');
//        $this->cell(30,9,'Level',0,0,'L');
//        $this->cell(55,9,user('department'),0,0,'L');
        $this->Ln(8);

        $this->cell(60,9,'Department',0,0,'L');
        $this->cell(50,9,user('department'),0,0,'L');
        $this->cell(30,9,'Level',0,0,'L');
        $this->cell(55,9,user('department'),0,0,'L');
        $this->Ln(8);


        $this->cell(60,9,'Gender',0,0,'L');
        $this->cell(50,9,user('gender'),0,0,'L');
//        $this->cell(30,9,'State',0,0,'L');
//        $this->cell(55,9,user('state').' State',0,0,'L');
        $this->Ln(8);


        $this->cell(60,9,'Matriculation Year',0,0,'L');
        $this->cell(50,9,user('matric_year'),0,0,'L');
        $this->cell(30,9,'Mode',0,0,'L');
        $this->cell(55,9,user('admission'),0,0,'L');
        $this->Ln(8);


        $this->cell(60,9,'Address',0,0,'L');
        $this->cell(120,9,ucwords(user('address')),0,0,'L');
        $this->Ln(12);


        $this->SetFont('Arial','B',10);
        $this->cell(195,9,strtoupper('Guardian / Next of Kin'),1,0,'C');
        $this->Ln(15);

        $this->cell(60,9,'Guardian Name',0,0,'L');
        $this->cell(50,9,user('guardian_name'),0,0,'L');
        $this->cell(30,9,'Phone',0,0,'L');
        $this->cell(55,9,user('guardian_phone'),0,0,'L');
        $this->Ln(8);

        $this->cell(60,9,'Guardian Address',0,0,'L');
        $this->cell(120,9,ucwords(user('guardian_address')),0,0,'L');
        $this->Ln(8);

        $this->cell(60,9,'Next of Kin Name',0,0,'L');
        $this->cell(50,9,user('kin_name'),0,0,'L');
        $this->cell(30,9,'Phone',0,0,'L');
        $this->cell(55,9,user('kin_phone'),0,0,'L');
        $this->Ln(8);

        $this->cell(60,9,'Next of Kin Address',0,0,'L');
        $this->cell(120,9,ucwords(user('kin_address')),0,0,'L');
        $this->Ln(15);




    }

    function Footer()
    {
        $this->SetFont('Arial','B',10);
        // $this->SetFillColor(180,180,255);
        // $this->SetDrawColor(50,60,150);
        $this->cell(195,9,strtoupper('declaration'),1,0,'L');
        $this->Ln(8);
        $this->cell(195,9,'I declare that this information stated aboveis to the best of my knowledge and belief accurate in every details,',0,0,'L');
        $this->Ln(6);
        $this->cell(195,9,'and if at any time is discovered that the information. I have given is false o Incorrect. I will be required to widthdraw',0,0,'L');
        $this->Ln(6);
        $this->cell(195,9,'or be liable to prosecution or both. I also declare that I shall abide by the rules of the institution.',0,0,'L');
        $this->Ln(8);

        $this->cell(25,9,'Signature',0,0,'L');
        $this->cell(30,9,'______________________________________',0,0,'L');
        $this->Ln(7);

        $this->cell(31,9,'Account Officer',0,0,'L');
        $this->cell(80,9,'______________________________________',0,0,'L');
        $this->Ln(7);

        $this->cell(31,9,'School Officer',0,0,'L');
        $this->Ln(7);
        $this->cell(21,9,'Name',0,0,'L');

        $this->cell(70,9,'___________________________________',0,0,'L');
        $this->Ln(7);

        $this->cell(21,9,'Sign',0,0,'L');
        $this->cell(70,9,'___________________________________',0,0,'L');
        $this->Ln(7);
    }
}


$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
//$pdf->Image('../img/logo.png',10,60,189);
$pdf->SetFont('Arial','B',11);
$pdf->output();