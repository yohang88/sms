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
        $num_days = date('t');
        $days     = array();
        for($n = 0; $n < $num_days; $n++) {
            $days[] = $n+1;
        }

        $inbox     = array();
        $outbox    = array();
        $failed    = array();

        for($n = 0; $n < $num_days; $n++) {
            $inbox[$n] = $this->message->getStatistic('RECEIVED', $n+1);
            $outbox[$n] = $this->message->getStatistic('SENT', $n+1);
            $failed[$n] = $this->message->getStatistic('FAILED', $n+1);
        }

        require_once ('application/libraries/jpgraph/jpgraph.php');
        require_once ('application/libraries/jpgraph/jpgraph_line.php');

        $datay1 = $inbox;
        $datay2 = $outbox;
        $datay3 = $failed;

        // Setup the graph
        $graph = new Graph(700,400);
        $graph->SetScale("textlin");

        $theme_class=new UniversalTheme;

        $graph->SetTheme($theme_class);
        $graph->img->SetAntiAliasing(false);
        $graph->title->Set('Statistik SMS');
        $graph->SetBox(false);

        $graph->img->SetAntiAliasing();

        $graph->yaxis->HideZeroLabel();
        $graph->yaxis->HideLine(false);
        $graph->yaxis->HideTicks(false,false);

        $graph->xgrid->Show();
        $graph->xgrid->SetLineStyle("solid");
        $graph->xaxis->SetTickLabels($days);
        $graph->xgrid->SetColor('#E3E3E3');

        $p1 = new LinePlot($datay1);
        $graph->Add($p1);
        $p1->SetColor("#00CE00");
        $p1->SetLegend('Masuk');

        $p2 = new LinePlot($datay2);
        $graph->Add($p2);
        $p2->SetColor("#001AFF");
        $p2->SetLegend('Terkirim');

        $p3 = new LinePlot($datay3);
        $graph->Add($p3);
        $p3->SetColor("#FF0035");
        $p3->SetLegend('Gagal Terkirim');

        $graph->legend->SetFrameWeight(1);

        // Output line
        $graph->Stroke();
    }
}
