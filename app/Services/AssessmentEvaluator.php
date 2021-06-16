<?php

namespace App\Services;

use App\AssessmentScore;
use App\TraitModel;

class AssessmentEvaluator
{
    private $noQs;

    private $rawScores;
    private $total;

    private $answerIndexes;
    private $traitIndexes;
    private $traitNames;

    /**
     * Create a new service instance.
     */
    public function __construct()
    {
        // Set class properties
        // Number of questions (initially 210)
        $this->noQs = config('assessment.questions_number', 210);

        // Define the raw scores
        $this->rawScores = array(
            //Extras.  These are numbered 1-10 as far as the user is concerned.
            // (and the remainder are numbered 11-201 in their eyes).
            201 => array("A",  4, 3, 2, 1, 0),
            202 => array("B",  4, 3, 2, 1, 0),
            203 => array("C",  4, 3, 2, 1, 0),
            204 => array("D",  4, 3, 2, 1, 0),
            205 => array("E",  4, 3, 2, 1, 0),
            206 => array("F",  0, 1, 2, 3, 4),
            207 => array("G",  4, 3, 2, 1, 0),
            208 => array("H",  0, 1, 2, 3, 4),
            209 => array("I",  2, 1, 0, 0, 0),
            210 => array("J",  0, 1, 2, 3, 4),

            1 => array("A",  0, 2, 4, 6, 8), //024
            8 => array("A",  0, 2, 4, 5, 6), //023
            15 => array("A",  0, 0, 0, 3, 6), //003
            17 => array("A",  0, 2, 4, 5, 6), //023
            42 => array("A",  4, 2, 0, 0, 0), //200
            46 => array("A",  0, 0, 0, 2, 4), //002
            52 => array("A",  0, 1, 2, 2, 2), //011
            58 => array("A",  6, 3, 0, 0, 0), //300
            83 => array("A",  0, 0, 0, 3, 6), //003
            87 => array("A",  0, 0, 0, 2, 4), //002
            93 => array("A",  4, 2, 0, 0, 0), //200
            96 => array("A",  8, 6, 4, 2, 0), //420
            124 => array("A",  8, 5, 2, 1, 0), //014
            128 => array("A",  0, 1, 2, 4, 6), //013
            131 => array("A",  6, 4, 2, 1, 0), //310
            138 => array("A",  4, 2, 0, 0, 0), //200
            165 => array("A",  6, 3, 0, 0, 0), //300
            169 => array("A",  8, 5, 2, 1, 0), //014
            173 => array("A",  8, 5, 2, 1, 0), //410
            176 => array("A",  0, 0, 0, 4, 8), //004

            21 => array("B",  0, 1, 2, 5, 8), //014
            27 => array("B",  2, 1, 0, 0, 0), //100
            33 => array("B",  6, 5, 4, 2, 0), //320
            36 => array("B",  0, 2, 4, 5, 6), //023
            62 => array("B",  2, 1, 0, 0, 0), //100
            68 => array("B",  6, 4, 2, 1, 0), //310
            71 => array("B",  0, 2, 4, 5, 6), //023
            78 => array("B",  0, 3, 6, 7, 8), //034
            101 => array("B",  2, 1, 0, 0, 0), //100
            106 => array("B",  0, 1, 2, 6, 10), //015
            113 => array("B",  6, 4, 2, 1, 0), //310
            116 => array("B",  6, 4, 2, 1, 0), //310
            141 => array("B",  0, 3, 6, 7, 8), //034
            148 => array("B",  0, 1, 2, 4, 6), //013
            151 => array("B",  8, 7, 6, 3, 0), //034
            158 => array("B",  4, 4, 4, 2, 0), //220
            181 => array("B",  0, 0, 0, 3, 6), //003
            188 => array("B",  0, 0, 0, 4, 8), //004
            192 => array("B",  0, 2, 4, 6, 8), //024
            196 => array("B",  0, 3, 6, 7, 8), //034

            2 => array("C",  6, 5, 4, 2, 0), //320
            6 => array("C",  0, 0, 0, 3, 6), //003
            11 => array("C",  4, 3, 2, 1, 0), //012
            18 => array("C",  0, 4, 8, 8, 8), //044
            43 => array("C",  0, 0, 0, 1, 2), //001
            47 => array("C",  0, 3, 6, 7, 8), //034
            53 => array("C",  0, 1, 2, 4, 6), //013
            56 => array("C",  4, 2, 0, 0, 0), //200
            81 => array("C",  6, 3, 0, 0, 0), //300
            86 => array("C",  0, 2, 4, 6, 8), //024
            91 => array("C",  0, 1, 2, 4, 6), //013
            97 => array("C",  4, 4, 4, 2, 0), //220
            122 => array("C",  0, 1, 2, 4, 6), //013
            130 => array("C",  0, 2, 4, 5, 6), //023
            132 => array("C",  0, 2, 4, 6, 8), //024
            136 => array("C",  0, 2, 4, 4, 4), //022
            164 => array("C",  6, 6, 6, 3, 0), //330
            166 => array("C",  0, 0, 0, 3, 6), //003
            171 => array("C",  6, 3, 0, 0, 0), //003
            177 => array("C",  4, 2, 0, 0, 0), //200

            22 => array("D",  0, 4, 8, 9, 10), //045
            26 => array("D",  0, 1, 2, 5, 8), //014
            32 => array("D",  8, 6, 4, 2, 0), //024
            40 => array("D",  0, 1, 2, 4, 6), //013
            61 => array("D",  0, 2, 4, 6, 8), //024
            67 => array("D",  0, 2, 4, 5, 6), //023
            73 => array("D",  0, 2, 4, 5, 6), //023
            76 => array("D",  0, 2, 4, 7, 10), //025
            102 => array("D",  0, 1, 2, 4, 6), //013
            108 => array("D",  0, 1, 2, 3, 4), //012
            111 => array("D",  0, 2, 4, 5, 6), //023
            117 => array("D",  0, 1, 2, 3, 4), //012
            142 => array("D",  0, 2, 4, 6, 8), //024
            146 => array("D",  0, 2, 4, 6, 8), //024
            153 => array("D",  0, 2, 4, 6, 8), //024
            156 => array("D",  8, 6, 4, 2, 0), //420
            184 => array("D",  0, 1, 2, 4, 6), //013
            186 => array("D",  0, 2, 4, 6, 8), //024
            191 => array("D",  0, 3, 6, 7, 8), //034
            197 => array("D",  0, 2, 4, 5, 6), //023

            3 => array("E",  6, 4, 2, 1, 0), //310
            7 => array("E",  4, 3, 2, 1, 0), //012
            12 => array("E",  0, 2, 4, 6, 8), //024
            16 => array("E",  0, 1, 2, 2, 2), //011
            41 => array("E",  4, 2, 0, 0, 0), //200
            48 => array("E",  4, 3, 2, 1, 0), //012
            51 => array("E",  6, 5, 4, 2, 0), //320
            57 => array("E",  2, 1, 0, 0, 0), //100
            85 => array("E",  6, 3, 0, 0, 0), //300
            90 => array("E",  0, 0, 0, 2, 4), //002
            92 => array("E",  0, 1, 2, 2, 2), //011
            99 => array("E",  0, 2, 4, 5, 6), //023
            121 => array("E",  0, 0, 0, 1, 2), //001
            127 => array("E",  2, 1, 0, 0, 0), //100
            134 => array("E",  2, 2, 2, 1, 0), //110
            137 => array("E",  0, 0, 0, 3, 6), //003
            162 => array("E",  6, 4, 2, 1, 0), //310
            168 => array("E",  6, 4, 2, 1, 0), //310
            175 => array("E",  0, 1, 2, 6, 10), //015
            179 => array("E",  0, 1, 2, 6, 10), //015

            23 => array("F",  4, 3, 2, 1, 0), //210
            29 => array("F",  6, 3, 0, 0, 0), //300
            31 => array("F",  2, 1, 0, 0, 0), //100
            38 => array("F",  0, 0, 0, 1, 2), //001
            65 => array("F",  0, 0, 0, 1, 2), //001
            66 => array("F",  6, 4, 2, 1, 0), //310
            72 => array("F",  0, 1, 2, 2, 2), //011
            79 => array("F",  4, 3, 2, 1, 0), //210
            103 => array("F",  0, 0, 0, 2, 4), //002
            107 => array("F",  0, 1, 2, 5, 8), //014
            114 => array("F",  6, 4, 2, 1, 0), //310
            120 => array("F",  0, 1, 2, 3, 4), //210
            145 => array("F",  4, 4, 4, 2, 0), //220
            147 => array("F",  4, 2, 0, 0, 0), //200
            154 => array("F",  0, 0, 0, 2, 4), //002
            159 => array("F",  6, 5, 4, 2, 0), //320
            185 => array("F",  6, 6, 6, 3, 0), //330
            187 => array("F",  0, 0, 0, 2, 4), //002
            195 => array("F",  0, 2, 4, 6, 8), //420
            199 => array("F",  0, 3, 6, 8, 10), //035

            4 => array("G",  0, 1, 2, 4, 6), //013
            10 => array("G",  2, 1, 0, 0, 0), //100
            13 => array("G",  4, 3, 2, 1, 0), //210
            20 => array("G",  4, 4, 4, 2, 0), //220
            45 => array("G",  0, 1, 2, 3, 4), //012
            49 => array("G",  4, 2, 0, 0, 0), //200
            55 => array("G",  0, 3, 6, 7, 8), //034
            60 => array("G",  0, 3, 6, 7, 8), //034
            82 => array("G",  0, 1, 2, 4, 6), //013
            89 => array("G",  0, 3, 6, 7, 8), //034
            95 => array("G",  0, 1, 2, 3, 4), //012
            100 => array("G",  6, 5, 4, 2, 0), //320
            123 => array("G",  4, 3, 2, 1, 0), //210
            126 => array("G",  0, 0, 0, 2, 4), //002
            133 => array("G",  6, 4, 2, 1, 0), //310
            140 => array("G",  8, 7, 6, 3, 0), //034
            161 => array("G",  0, 3, 6, 7, 8), //034
            167 => array("G",  8, 6, 4, 2, 0), //420
            172 => array("G",  0, 1, 2, 4, 6), //013
            180 => array("G",  0, 2, 4, 5, 6), //023

            24 => array("H",  6, 5, 4, 2, 0), //023
            30 => array("H",  0, 1, 2, 4, 6), //013
            35 => array("H",  6, 6, 6, 3, 0), //330
            37 => array("H",  0, 1, 2, 4, 6), //013
            63 => array("H",  2, 1, 0, 0, 0), //100
            70 => array("H",  0, 0, 0, 1, 2), //001
            74 => array("H",  0, 2, 4, 6, 8), //024
            80 => array("H",  6, 3, 0, 0, 0), //300
            105 => array("H",  6, 4, 2, 1, 0), //310
            109 => array("H",  0, 1, 2, 3, 4), //012
            115 => array("H",  0, 1, 2, 4, 6), //013
            119 => array("H",  4, 3, 2, 1, 0), //210
            143 => array("H",  0, 2, 4, 6, 8), //024
            150 => array("H",  0, 3, 6, 7, 8), //034
            152 => array("H",  6, 5, 4, 2, 0), //320
            157 => array("H",  10, 8, 6, 3, 0), //530
            182 => array("H",  0, 1, 2, 4, 6), //013
            189 => array("H",  0, 2, 4, 4, 4), //022
            194 => array("H",  0, 1, 2, 3, 4), //012
            198 => array("H",  0, 3, 6, 7, 8), //034

            5 => array("I",  0, 0, 0, 1, 2), //001
            9 => array("I",  0, 1, 2, 2, 2), //011
            14 => array("I",  0, 2, 4, 5, 6), //023
            19 => array("I",  4, 2, 0, 0, 0), //200
            44 => array("I",  0, 1, 2, 5, 8), //014
            50 => array("I",  2, 2, 2, 1, 0), //110
            54 => array("I",  6, 3, 0, 0, 0), //300
            59 => array("I",  0, 2, 4, 6, 8), //024
            84 => array("I",  8, 5, 2, 1, 0), //410
            88 => array("I",  4, 3, 2, 1, 0), //210
            94 => array("I",  2, 1, 0, 0, 0), //100
            98 => array("I",  0, 0, 0, 1, 2), //001
            125 => array("I",  0, 2, 4, 5, 6), //023
            129 => array("I",  0, 3, 6, 7, 8), //034
            135 => array("I",  0, 2, 4, 5, 6), //023
            139 => array("I",  2, 1, 0, 0, 0), //100
            163 => array("I",  2, 1, 0, 0, 0), //100
            170 => array("I",  4, 3, 2, 1, 0), //012
            174 => array("I",  4, 3, 2, 1, 0), //210
            178 => array("I",  4, 2, 0, 0, 0), //200

            25 => array("J",  4, 2, 0, 3, 6), //204
            28 => array("J",  8, 4, 0, 0, 0), //400
            34 => array("J",  6, 3, 0, 0, 0), //300
            39 => array("J",  0, 1, 2, 3, 4), //012
            64 => array("J",  0, 0, 0, 4, 8), //004
            69 => array("J",  6, 3, 0, 0, 0), //300
            75 => array("J",  4, 2, 0, 0, 0), //200
            77 => array("J",  8, 4, 0, 0, 0), //400
            104 => array("J",  0, 1, 2, 5, 8), //014
            110 => array("J",  0, 0, 0, 1, 2), //100
            112 => array("J",  8, 4, 0, 0, 0), //400
            118 => array("J",  10, 5, 0, 0, 0), //500
            144 => array("J",  4, 3, 2, 1, 0), //210
            149 => array("J",  0, 2, 4, 4, 4), //022
            155 => array("J",  12, 6, 0, 0, 0), //600
            160 => array("J",  0, 0, 0, 4, 8), //004
            183 => array("J",  0, 2, 4, 6, 8), //024
            190 => array("J",  8, 4, 0, 0, 0), //400
            193 => array("J",  4, 3, 2, 1, 0), //210
            200 => array("J",  4, 2, 0, 0, 0) //200
        );

        // Initialise Totals possible
        $this->total = array("A" => array(0,0,0,0,0),
            "B" => array(0,0,0,0,0),
            "C" => array(0,0,0,0,0),
            "D" => array(0,0,0,0,0),
            "E" => array(0,0,0,0,0),
            "F" => array(0,0,0,0,0),
            "G" => array(0,0,0,0,0),
            "H" => array(0,0,0,0,0),
            "I" => array(0,0,0,0,0),
            "J" => array(0,0,0,0,0)
        );

        // Answers indexes mapping
        $this->answerIndexes = [
            'Y' => 1,
            '+' => 2,
            'M' => 3,
            '-' => 4,
            'N' => 5
        ];

        // Trait indexes mapping
        $this->traitIndexes = [
            0 => "A",
            1 => "B",
            2 => "C",
            3 => "D",
            4 => "E",
            5 => "F",
            6 => "G",
            7 => "H",
            8 => "I",
            9 => "J"
        ];

        // Trait names
        $this->traitNames = array(
            "A" => array("Stable", "Unstable", null, "Disperesed"),
            "B" => array("Happy", "Depressed", null, null),
            "C" => array("Composed", "Nervous", null, null),
            "D" => array("Personable", "Undependable", "Serene", "Cyclic"),
            "E" => array("Active", "Passive", null, null),
            "F" => array("Capable", "Inhibited", null, null),
            "G" => array("Responsible", "Irresponsible", null, null),
            "H" => array("Logical Reasoning", "Capacity for Error", "Appreciation", "Hyper Critical"),
            "I" => array("Appreciative", "Lack of Accord", "Empathy", null),
            "J" => array("Communicative", "Withdrawn", null, null)
        );
    }


    /**
     * Evaluate array of 210 answers and calculate score.
     *
     * @param int $assessment_id
     * @param array $ans
     * @param string $gender
     * @param string $adult
     *
     * @return bool
     */
    public function evaluate($assessment_id, array $ans, $gender, $adult)
    {
        // Work out scores for Y/M/N/min/max
        for ($j = 1; $j <= $this->noQs; $j++) {
            $min = 9;
            $max = -1;
            $this->total[$this->rawScores[$j][0]][0] += $this->rawScores[$j][1];
            $this->total[$this->rawScores[$j][0]][1] += $this->rawScores[$j][3];
            $this->total[$this->rawScores[$j][0]][2] += $this->rawScores[$j][5];
            for ($i = 1; $i <= 5; $i++) {
                if ($min > $this->rawScores[$j][$i]) {
                    $min = $this->rawScores[$j][$i];
                }
                if ($max < $this->rawScores[$j][$i]) {
                    $max = $this->rawScores[$j][$i];
                }
            }
            $this->total[$this->rawScores[$j][0]][3] += $min;
            $this->total[$this->rawScores[$j][0]][4] += $max;
        }

        // Make switch of questions numbering to match legacy algorithm:
        // #1-10 >> #201-210
        // #11-210 >> #1-200
        $ansSwitch = [];
        for ($i = 1; $i <= $this->noQs; $i++) {
            if ($i >= 1 && $i <= 10) {
                $ansSwitch[$i+200] = $ans[$i];
            } else if ($i >= 11 && $i <= 210) {
                $ansSwitch[$i-10] = $ans[$i];
            }
        }
        ksort($ansSwitch);
        $ans = $ansSwitch;
        // END switch of questions numbering to match legacy algorithm:

        // Add up actual raw scores
        $userRaw = [];
        for ($i = 1; $i <= $this->noQs; $i++) {
            $ans[$i] = $this->getAnswerIndex($ans[$i]);

            if (!isset($userRaw[$this->rawScores[$i][0]])) {
                $userRaw[$this->rawScores[$i][0]] = 0;
            }
            $userRaw[$this->rawScores[$i][0]] += $this->rawScores[$i][$ans[$i]];
        }


        // Start results/score html content generation
        $html_content = "";

        // Print weighted scores
        $html_content .= "<p>Weighted scores (ranging from -100 to 100) on each of 10 traits:</p>";
        $html_content .= '<br><table class="table table-bordered table-hover">';

        // Compute weighted scores and average
        $avg = 0;
        for ($i=0; $i<10; $i++) {
            // $actualWS[$i] = round($this->weighted($this->traitIndexes[$i], 'M', $adult, $userRaw[$this->traitIndexes[$i]], $this->total[$this->traitIndexes[$i]][3], $this->total[$this->traitIndexes[$i]][4]));            
            $actualWS[$i] = round($this->weighted($this->traitIndexes[$i], $gender !== 'M' || $gender !== 'F' ? 'M' : $gender, $adult, $userRaw[$this->traitIndexes[$i]], $this->total[$this->traitIndexes[$i]][3], $this->total[$this->traitIndexes[$i]][4]));
            $avg += $actualWS[$i];
        }
        $avg = round($avg/10);

        // Continue printing scores
        for ($i=0; $i<10; $i++) {
            $html_content .= "<tr><td>".$this->traitIndexes[$i]."</td><td align=right>";
            $html_content .= $actualWS[$i]."</td><td>";
            $html_content .= $this->getEval($actualWS[$i], $avg)."</td><td>";
            $html_content .= $this->getTraitDescription($this->traitIndexes[$i])."</td></tr>";
        }


        // Store assessment score
        for ($i=0; $i<10; $i++) {
            $trait_id = TraitModel::select('id')
                ->where('key', $this->traitIndexes[$i])
                ->first()->id;

            AssessmentScore::create([
                'assessment_id' => $assessment_id,
                'trait_id' => $trait_id,
                'score' => $actualWS[$i]
            ]);
        }
        //END

        $html_content .= "</table>";
        $html_content .= "<br clear='all'>";
        $html_content .= "<p>";
        $html_content .= "Generally, a score above 60 is good, above 20 is OK, between -20 and 20 is in ";
        $html_content .= "need of attention, below -20 is poor and below -60 very poor. ";
        $html_content .= "Also, ideally, a profile should show relatively little deviation in score from one trait ";
        $html_content .= "to the next.  The average weighted score for this profile is ".$avg." and any trait ";
        $html_content .= "significantly abve or below that (40 or more points away) is highlighted above as ";
        $html_content .= '"High/Low compared to average".';
        $html_content .= "</p>";

        $html_content .= "<p>";
        $html_content .= "A more specific tool to establish what is very low, low, high ";
        $html_content .= "and very high on each specific trait is the Scale of Traits Chart ";
        $html_content .= "you received in your certification training.";
        $html_content .= "</p>";
        $html_content .= "<br clear='all'>";

        // Graph
        $chart_hash = substr(md5($assessment_id), 0, 16);
        $html_content .= '<p><img src="/images/score-charts/'. $chart_hash .'.png" id="score-chart"></p>';
        //END

        // Print other obeservations
        $html_content .= "<h4>Other Observations</h4>";
        $noOtherObs = true;
        $totalY = 0;
        $totalM = 0;
        $totalN = 0;
        for ($i = 1; $i <= $this->noQs; $i++) {
            global $totalY, $totalM, $totalN;
            if ($ans[$i] == 1) $totalY++;
            if ($ans[$i] == 3) $totalM++;
            if ($ans[$i] == 5) $totalN++;
        }

        if ($totalM > ($this->noQs * 0.3)) {
            $noOtherObs = false;
            $html_content .= "<p><u>Total questions unanswered or answered with maybe greater than 30%</u>";
            $html_content .= "<br>Uncertain attitude towards life or unable to think through the questions.</p>";
        } else if (($totalY + $totalN) < ($this->noQs * 0.3)) {
            $noOtherObs = false;
            $html_content .= "<p><u>Total questions answered with definite yes or no less than 30%</u>";
            $html_content .= "<br>Uncertain attitude towards life or unable to think through the questions.</p>";
        }

        if ($ans[22] == 1) {
            $noOtherObs = false;
            $html_content .= "<p><u>Question 32 answered yes</u>";
            $html_content .= "<br>Activity (or lack thereof) can be assumed to fluctuate.</p>";
        }

        if ($ans[197] == 1) {
            $noOtherObs = false;
            $html_content .= "<p><u>Question 207 answered yes</u>";
            $html_content .= "<br>Degree of happiness/depression can be assumed to fluctuate.</p>";
        }

        if ($ans[22] == 1 and $ans[197] == 1 and $this->isLow($actualWS[3], $avg)) {
            $noOtherObs = false;
            $html_content .= "<p><u>Questions 32, 207 both answered yes and low trait D</u>";
            $html_content .= "<br>Extremely unstable.</p>";
        }

        if ($this->isLow($actualWS[8], $avg) and $this->isLow($actualWS[9], $avg)) {
            $noOtherObs = false;
            $html_content .= "<p><u>Low on trait I and J</u>";
            $html_content .= "<br>Out of comm.</p>";
        }

        if ($this->isHigh($actualWS[1], $avg) and $this->isLow($actualWS[3], $avg) and $this->isLow($actualWS[4], $avg)) {
            $noOtherObs = false;
            $html_content .= "<p><u>High trait B, Low trait D and E</u>";
            $html_content .= "<br>Euphoric or manic. Glee of insanity.</p>";
        }

        if ($this->isLow($actualWS[1], $avg) and $this->isHigh($actualWS[3], $avg)) {
            $noOtherObs = false;
            $html_content .= "<p><u>Low trait B, High trait D</u>";
            $html_content .= '<br>"Well schooled" serene valence.</p>';
        }

        if ($this->isLow($actualWS[0], $avg) and $this->isLow($actualWS[1], $avg)
            and $this->isHigh($actualWS[3], $avg) and $this->isHigh($actualWS[4], $avg)) {
            $noOtherObs = false;
            $html_content .= "<p><u>Low traits A, B with High trait D and E</u>";
            $html_content .= "<br>Heading for nervous breakdown.</p>";
        }

        if ($this->isLow($actualWS[2], $avg) and $this->isHigh($actualWS[4], $avg)) {
            $noOtherObs = false;
            $html_content .= "<p><u>Low trait C, High trait E</u>";
            $html_content .= "<br>Compulsive activity, unable to rest.</p>";
        }

        if ($this->isHigh($actualWS[5], $avg) and $this->isLow($actualWS[1], $avg) and $this->isLow($actualWS[6], $avg)) {
            $noOtherObs = false;
            $html_content .= "<p><u>High trait F, Low traits B, G</u>";
            $html_content .= "<br>At least two valences, one superior and the other inferior.";
            if ($this->isLow($actualWS[7], $avg)) {
                $html_content .= "<br>Low H as well = Paranoid. Hard to get along with";
            }
            $html_content .= "</p>";

        } else if ($this->isHigh($actualWS[5], $avg) and $this->isLow($actualWS[6], $avg)) {
            $noOtherObs = false;
            $html_content .= "<p><u>High trait F, Low trait G</u>";
            $html_content .= "<br>Feels superior.";
            if ($this->isLow($actualWS[7], $avg)) {
                $html_content .= "<br>Low H as well = Paranoid. Hard to get along with";
            }
            $html_content .= "</p>";

        } else if ($this->isLow($actualWS[1], $avg) and $this->isLow($actualWS[6], $avg)) {
            $noOtherObs = false;
            $html_content .= "<p><u>Low trait B and G</u>";
            $html_content .= "<br>Feels inferior.</p>";
        }

        if ($this->isLow($actualWS[1], $avg) and $this->isLow($actualWS[2], $avg) and $this->isLow($actualWS[3], $avg)) {
            $noOtherObs = false;
            $html_content .= "<p><u>Low traits B, C, D</u>";
            $html_content .= "<br>Neurotic, possible life PTP or stress condition (PTS?).</p>";
        }

        if ($this->isLow($actualWS[4], $avg) and $this->isLow($actualWS[5], $avg) and $this->isLow($actualWS[9], $avg)) {
            $noOtherObs = false;
            $html_content .= "<p><u>Low traits E, F, J</u>";
            $html_content .= "<br>Low havingness, possible hormone deficiency or other physical disorder.</p>";
        }

        if ($this->isLow($actualWS[0], $avg) and $this->isLow($actualWS[2], $avg)) {
            $noOtherObs = false;
            $html_content .= "<p><u>Low trait A and C</u>";
            $html_content .= "<br>Angry outbursts.";
            if ($this->isHigh($actualWS[5], $avg)) {
                $html_content .= "<br>Particularly so with high trait F.";
            }
            $html_content .= "</p>";
        }

        if ($this->isHighAvg($actualWS[6], $avg) and $this->isHighAvg($actualWS[8], $avg)) {
            $noOtherObs = false;
            $html_content .= "<p><u>Higher than average G and I</u>";
            $html_content .= "<br>Probably lying, has persecution or martyr complex.</p>";
        }

        if ($this->isHigh($actualWS[8], $avg) and $this->isLow($actualWS[0], $avg)) {
            $noOtherObs = false;
            $html_content .= "<p><u>High I, low A</u>";
            $html_content .= "<br>Danger of falling prey to confidence tricks.</p>";
        }

        if ($this->isHigh($actualWS[9], $avg) and
            ($this->isLow($actualWS[7], $avg) or $this->isLow($actualWS[8], $avg))) {
            $noOtherObs = false;
            $html_content .= "<p><u>High J, low H or I</u>";
            $html_content .= "<br>Communication is compulsive.</p>";
        }

        if ($noOtherObs) {
            $html_content .= "<p>None.</p>";
        }

        $html_content .= "<br><br>";

        return $html_content;
    }


    /*
     * CLASS PRIVATE METHODS
     */

    /**
     * Convert a raw score into a weighted score
     *
     * @param string $trait
     * @param string $male
     * @param string $adult
     * @param float|int $raw
     * @param float|int $min
     * @param float|int $max
     *
     * @return float|int
     */
    private function weighted($trait, $male, $adult, $raw, $min, $max) {
        $weightedScore["A"]["F"]["Y"] = array(0.16666, 0.01666, 0.51960);
        $weightedScore["A"]["M"]["Y"] = array(0.30000, 0.01666, 0.54651);
        $weightedScore["B"]["F"]["Y"] = array(0.06250, 0.12500, 0.73444);
        $weightedScore["B"]["M"]["Y"] = array(0.32812, 0.03125, 0.57823);
        $weightedScore["C"]["F"]["Y"] = array(0.05263, 0.10526, 0.60500);
        $weightedScore["C"]["M"]["Y"] = array(0.15789, 0.01754, 0.70734);
        $weightedScore["D"]["F"]["Y"] = array(0.01408, 0.01408, 0.48591);
        $weightedScore["D"]["M"]["Y"] = array(0.02816, 0.01408, 0.47857);
        $weightedScore["E"]["F"]["Y"] = array(0.01851, 0.07407, 0.35098);
        $weightedScore["E"]["M"]["Y"] = array(0.01851, 0.09259, 0.38660);
        $weightedScore["F"]["F"]["Y"] = array(0.02000, 0.04000, 0.26122);
        $weightedScore["F"]["M"]["Y"] = array(0.02000, 0.02000, 0.36660);
        $weightedScore["G"]["F"]["Y"] = array(0.07407, 0.01851, 0.70588);
        $weightedScore["G"]["M"]["Y"] = array(0.09259, 0.01851, 0.69000);
        $weightedScore["H"]["F"]["Y"] = array(0.15000, 0.01666, 0.75000);
        $weightedScore["H"]["M"]["Y"] = array(0.08333, 0.01666, 0.77964);
        $weightedScore["I"]["F"]["Y"] = array(0.06000, 0.02000, 0.61052);
        $weightedScore["I"]["M"]["Y"] = array(0.06000, 0.02000, 0.62631);
        $weightedScore["J"]["F"]["Y"] = array(0.07812, 0.01562, 0.63000);
        $weightedScore["J"]["M"]["Y"] = array(0.06250, 0.01562, 0.65016);

        $weightedScore["A"]["F"]["N"] = array(0.05000, 0.01666, 0.50000);
        $weightedScore["A"]["M"]["N"] = array(0.08333, 0.01666, 0.55357);
        $weightedScore["B"]["F"]["N"] = array(0.09375, 0.04687, 0.69122);
        $weightedScore["B"]["M"]["N"] = array(0.09375, 0.04687, 0.76315);
        $weightedScore["C"]["F"]["N"] = array(0.03508, 0.01754, 0.69196);
        $weightedScore["C"]["M"]["N"] = array(0.10526, 0.01754, 0.72596);
        $weightedScore["D"]["F"]["N"] = array(0.01408, 0.01408, 0.48591);
        $weightedScore["D"]["M"]["N"] = array(0.01408, 0.01408, 0.48591);
        $weightedScore["E"]["F"]["N"] = array(0.03703, 0.03703, 0.41346);
        $weightedScore["E"]["M"]["N"] = array(0.01851, 0.01851, 0.41962);
        $weightedScore["F"]["F"]["N"] = array(0.04000, 0.02000, 0.29591);
        $weightedScore["F"]["M"]["N"] = array(0.02000, 0.04000, 0.37755);
        $weightedScore["G"]["F"]["N"] = array(0.05555, 0.03703, 0.55392);
        $weightedScore["G"]["M"]["N"] = array(0.01851, 0.01851, 0.66666);
        $weightedScore["H"]["F"]["N"] = array(0.10000, 0.01666, 0.60454);
        $weightedScore["H"]["M"]["N"] = array(0.06666, 0.01666, 0.69578);
        $weightedScore["I"]["F"]["N"] = array(0.04000, 0.02000, 0.65641);
        $weightedScore["I"]["M"]["N"] = array(0.04000, 0.02000, 0.62564);
        $weightedScore["J"]["F"]["N"] = array(0.03125, 0.01562, 0.73412);
        $weightedScore["J"]["M"]["N"] = array(0.03125, 0.01562, 0.67190);

        $low  = (($max-$min)*$weightedScore[$trait][$male][$adult][0])+$min;
        $high = $max-(($max-$min)*$weightedScore[$trait][$male][$adult][1]);
        $mid  = (($max-$min)*$weightedScore[$trait][$male][$adult][2])+$min;

        if ($raw <= $low)
            return -100;
        if ($raw >= $high)
            return 100;
        if ($raw <= $mid)
            return (($raw-$low)/($mid-$low)*($raw-$low)/($mid-$low)*100)-100;
        return 100-(($high-$raw)/($high-$mid)*($high-$raw)/($high-$mid)*100);
    }

    /**
     * Return a long description of a trait
     *
     * @param string $trait
     *
     * @return string
     */
    private function getTraitDescription($trait) {
        $traitDescription = $this->traitNames[$trait][0];
        if ($this->traitNames[$trait][2] != null) {
            $traitDescription .= " (".$this->traitNames[$trait][2].")";
        }
        $traitDescription .= " vs. ";
        $traitDescription .= $this->traitNames[$trait][1];
        if ($this->traitNames[$trait][3] != null) {
            $traitDescription .= " (" . $this->traitNames[$trait][3] . ")";
        }
        return $traitDescription;
    }

    /**
     * Convert an answer to an array index
     *
     * @param string $answer
     *
     * @return int
     */
    private function getAnswerIndex($answer) {
        if (isset($this->answerIndexes[$answer])) {
            return $this->answerIndexes[$answer];
        } else {
            return 3;
        }
    }

    /**
     * Evaluate a single weighted score
     *
     * @param int $score
     * @param int $avg
     *
     * @return string
     */
    private function getEval($score, $avg) {
        if ($score > 60 && $this->isHighAvg($score, $avg)) {
            return "Good<br>High compared to average";
        }
        if ($score > 60 && $this->isLowAvg($score, $avg)) {
            return "Good<br>Low compared to average";
        }
        if ($score > 60) {
            return "Good";
        }

        if ($score > 20 && $this->isHighAvg($score, $avg)) {
            return "OK<br>High compared to average";
        }
        if ($score > 20 && $this->isLowAvg($score, $avg)) {
            return "OK<br>Low compared to average";
        }
        if ($score > 20) {
            return "OK";
        }

        if ($score <-60 && $this->isHighAvg($score, $avg)) {
            return "Very poor<br>High compared to average";
        }
        if ($score <-60 && $this->isLowAvg($score, $avg)) {
            return "Very poor<br>Low compared to average";
        }
        if ($score <-60) {
            return "Very poor";
        }

        if ($score <-20 && $this->isHighAvg($score, $avg)) {
            return "Poor<br>High compared to average";
        }
        if ($score <-20 && $this->isLowAvg($score, $avg)) {
            return "Poor<br>Low compared to average";
        }
        if ($score <-20) {
            return "Poor";
        }

        if ($this->isHighAvg($score, $avg)) {
            return "In need of attention<br>High compared to average";
        }
        if ($this->isLowAvg($score, $avg)) {
            return "In need of attention<br>Low compared to average";
        }

        return "In need of attention";
    }

    /**
     * Return true if a score is low compared to average
     *
     * @param $score
     * @param $avg
     *
     * @return bool
     */
    private function isLowAvg($score, $avg) {
        if ($score <= ($avg-40)) {
            return true;
        }
        return false;
    }

    /**
     * Return true if a score is high compared to average
     *
     * @param int $score
     * @param int $avg
     *
     * @return bool
     */
    private function isHighAvg($score, $avg) {
        if ($score >= ($avg+40)) {
            return true;
        }
        return false;
    }

    /**
     * Return true if a score is "low", i.e. below 60 or more than 40 below average
     *
     * @param int $score
     * @param int $avg
     *
     * @return bool
     */
    private function isLow($score, $avg) {
        if ($score < -60) {
            return true;
        }
        if ($this->isLowAvg($score, $avg)) {
            return true;
        }
        return false;
    }

    /**
     * Return true if a score is "high", i.e. above 60 or more than 40 above average
     *
     * @param int $score
     * @param int $avg
     *
     * @return bool
     */
    private function isHigh($score, $avg) {
        if ($score > 60) {
            return true;
        }
        if ($this->isHighAvg($score, $avg)) {
            return true;
        }
        return false;
    }

}
