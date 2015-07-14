<?php namespace App\Modules\Backend\Controllers;

class ReserveController extends BaseController {

    public function indexAction()
    {
        $data = $this->session->get('data');

        $seats = [];

        $maxRow  = 0;
        $maxCell = 0;

        foreach ($data as $record)
        {
            if ($record['row'] > $maxRow) $maxRow = $record['row'];
            if ($record['cell'] > $maxCell) $maxCell = $record['cell'];

            $seats[$record['row']][$record['cell']] = $record;
        }

        $this->view->setVars(compact('maxRow', 'maxCell', 'seats'));
    }

    public function createAction()
    {
        if ($this->request->isPost())
        {
            $maps = $this->request->getPost('maps');

            $lines = preg_split("~\n~", $maps);

            $data = [];

            $rowCount = 0;
            $cellCount = 0;

            foreach ($lines as $line)
            {
                $rowCount++;

                if (empty($line)) continue;

                $cellCount = 0;

                $cells = preg_split('~[^a-z0-9]~i', $line);

                foreach ($cells as $cell)
                {
                    $cellCount++;

                    if (empty($cell)) continue;

                    $data[] = [
                        'seat' => $cell,
                        'row'  => $rowCount,
                        'cell' => $cellCount
                    ];
                }
            }


            $this->session->set('data', $data);

            return $this->response->redirect('/admin/reserve');
        }
    }

}