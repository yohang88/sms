<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

   public function __construct()
   {
        parent::__construct();
        $this->user->on_invalid_session('auth');
   }

	public function index()
	{
        $data['config'] = $this->configurations->getConfig();

		$this->load->view('common/header');
		$this->load->view('home/index', $data);
		$this->load->view('common/footer');
	}

    public function renderStatistic()
    {
        require_once ('application/libraries/jpgraph/jpgraph.php');
        require_once ('application/libraries/jpgraph/jpgraph_line.php');

        $datay1 = array(20,15,23,15,20,20,20,50);
        $datay2 = array(12,9,42,8,50,20,23,75);
        $datay3 = array(5,17,32,24,22,66,4,22);

        // Setup the graph
        $graph = new Graph(700,400);
        $graph->SetScale("textlin");

        $theme_class=new UniversalTheme;

        $graph->SetTheme($theme_class);
        $graph->img->SetAntiAliasing(false);
        // $graph->title->Set('Statistik SMS');
        $graph->SetBox(false);

        $graph->img->SetAntiAliasing();

        $graph->yaxis->HideZeroLabel();
        $graph->yaxis->HideLine(false);
        $graph->yaxis->HideTicks(false,false);

        $graph->xgrid->Show();
        $graph->xgrid->SetLineStyle("solid");
        $graph->xaxis->SetTickLabels(array('21','22','23','24','25','26','27','28'));
        $graph->xgrid->SetColor('#E3E3E3');

        // Create the first line
        $p1 = new LinePlot($datay1);
        $graph->Add($p1);
        $p1->SetColor("#6495ED");
        $p1->SetLegend('Pesan Masuk');

        // Create the second line
        $p2 = new LinePlot($datay2);
        $graph->Add($p2);
        $p2->SetColor("#B22222");
        $p2->SetLegend('Pesan Terkirim');

        // Create the third line
        $p3 = new LinePlot($datay3);
        $graph->Add($p3);
        $p3->SetColor("#FF1493");
        $p3->SetLegend('Gagal Terkirim');

        $graph->legend->SetFrameWeight(1);

        // Output line
        $graph->Stroke();
    }
}
