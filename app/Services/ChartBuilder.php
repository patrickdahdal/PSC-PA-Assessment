<?php

namespace App\Services;

use Illuminate\Support\Facades\App;

class ChartBuilder
{
    /**
     * Input: assoc array of 10 traits scores
     * Return: imagecreate() resource ready to be saved with imagepng()
     *
     * @param array $data
     *
     * @return resource|bool
     */
    public static function buildChartImage(array $data)
    {
        // Validate chart data
        if (empty($data) || count($data) != 10) {
            return false;
        }
        

        // Chart legend
        $legend = ['A' => 'Attention', 'B' => 'Emotion', 'C' => 'Composure', 'D' => 'Certainty', 'E' => 'Activity',
            'F' => 'Boldness', 'G' => 'Responsibility', 'H' => 'Correct Estimation', 'I' => 'Empathy', 'J' => 'Communication'];

        // Traits labels alignment x-axis offsets in px
        $offset = ['A' => 25, 'B' => 20, 'C' => 30, 'D' => 20, 'E' => 16,
            'F' => 25, 'G' => 35, 'H' => 50, 'I' => 25, 'J' => 40];

        // Chart settings and create image
        // Image dimensions
        $imageWidth  = 1300;
        $imageHeight = 900;

        // Grid dimensions and placement within image
        $gridTop    = 100;
        $gridLeft   = 50;
        $gridBottom = 850;
        $gridRight  = 1250;
        $gridHeight = $gridBottom - $gridTop;
        $gridWidth  = $gridRight - $gridLeft;

        // Bar and line width
        $lineWidth = 2;
        $barWidth  = 40;

        // Min & max values on y-axis
        $yMinValue   = -100;
        $yMaxValue   = 100;
        $yAxisHeight = $yMaxValue - $yMinValue;
        $yAxisCorrection = ($yMinValue < 0 ? abs($yMinValue) : 0);

        // Font settings
        // FIXME: switch between Win/Unix file paths
        if (App::environment('local')) {
            $font    = 'C:\wamp64\www\pa-personalityassessment\public\google-fonts\robotocondensed\RobotoCondensed-Regular.ttf';
            $fontBig = 'C:\wamp64\www\pa-personalityassessment\public\google-fonts\roboto\Roboto-Bold.ttf';
        } else {
            $font    = '/var/www/personalityassessment.me/public/google-fonts/robotocondensed/RobotoCondensed-Regular.ttf';
            $fontBig = '/var/www/personalityassessment.me/public/google-fonts/roboto/Roboto-Bold.ttf';
        }
       
        
        $fontSize     = 11;
        $fontSizeBig  = 12;

        // Legend y-axis position
        $yLegendKey   = 20;
        $yLegendTrait = 50;
        $yLegendScore = 85;

        // Margin between label and axis
        $labelMargin = 8;

        // Distance between grid lines on y-axis
        $yLabelSpan = 20;

        // Init image
        $chart = imagecreate($imageWidth, $imageHeight);

        // Setup colors
        $backgroundColor = imagecolorallocate($chart, 255, 255, 255);
        $axisColor       = imagecolorallocate($chart, 85, 85, 85);
        $labelColor      = $axisColor;
        $gridColor       = imagecolorallocate($chart, 212, 212, 212);

        $barColors = [
            'A' => imagecolorallocate($chart, 204, 103, 204),
            'B' => imagecolorallocate($chart, 204, 103, 204),
            'C' => imagecolorallocate($chart, 204, 103, 204),
            'D' => imagecolorallocate($chart, 255, 102, 102),
            'E' => imagecolorallocate($chart, 140, 140, 255),
            'F' => imagecolorallocate($chart, 140, 140, 255),
            'G' => imagecolorallocate($chart, 140, 140, 255),
            'H' => imagecolorallocate($chart, 58, 194, 58),
            'I' => imagecolorallocate($chart, 58, 194, 58),
            'J' => imagecolorallocate($chart, 58, 194, 58)
        ];

        imagefill($chart, 0, 0, $backgroundColor);
        imagesetthickness($chart, $lineWidth);

        // Print grid lines bottom up
        for ($i = 0; $i <= $yAxisHeight; $i += $yLabelSpan) {
            $y = $gridBottom - $i * $gridHeight / $yAxisHeight;

            // Draw the line
            if ($i == $yAxisHeight) {
                // Top line must be solid
                imageline($chart, $gridLeft, $y, $gridRight, $y, $axisColor);
            } else {
                imageline($chart, $gridLeft, $y, $gridRight, $y, $gridColor);
            }
            
            // Draw right aligned label
            $yLabel = $i - $yAxisCorrection;
            
            $labelBox = imagettfbbox($fontSize, 0, $font, $yLabel);
            $labelWidth = $labelBox[4] - $labelBox[0];

            $labelX = $gridLeft - $labelWidth - $labelMargin;
            $labelY = $y + $fontSize / 2;

            imagettftext($chart, $fontSizeBig, 0, ($labelX - 5), ($labelY + 10), $labelColor, $fontBig, $yLabel);
        }

        // Add 'Traits' and 'Score' labels
        imagettftext($chart, $fontSize, 0, 7, (($yLegendKey + $yLegendTrait) / 2), $labelColor, $font, 'Traits');
        imagettftext($chart, $fontSize, 0, 7, $yLegendScore, $labelColor, $font, 'Score');

        // Draw x- and y-axis
        imageline($chart, $gridLeft, 0, $gridLeft, $gridBottom, $axisColor);
        imageline($chart, $gridLeft, $gridBottom, $gridRight, $gridBottom, $axisColor);

        // Draw top border line
        imageline($chart, $gridLeft, 1, $gridRight, 1, $axisColor);

        // Draw separator line between 'Traits' and 'Score'
        imageline($chart, $gridLeft, ($yLegendTrait + 10), $gridRight, ($yLegendTrait + 10), $axisColor);

        // Draw the bars with labels
        $barSpacing = $gridWidth / count($data);
        $itemX = $gridLeft + $barSpacing / 2;

        foreach ($data as $key => $score) {
            // Draw the bar
            $x1 = $itemX - $barWidth / 2;
            $y1 = $gridBottom - ($score + $yAxisCorrection) / $yAxisHeight * $gridHeight;
            $x2 = $itemX + $barWidth / 2;
            $y2 = $gridBottom - $lineWidth;

            imagefilledrectangle($chart, $x1, $y1, $x2, $y2, $barColors[$key]);

            // Draw the line
            if ($key != 'A') {
                $lineX = $itemX - $barWidth - 20;
                $lineY = $gridBottom - $lineWidth;
                imageline($chart, $lineX, 0, $lineX, $lineY, $gridColor);
            }

            // Draw the label
            $labelBox = imagettfbbox($fontSize, 0, $font, $key);
            $labelWidth = $labelBox[4] - $labelBox[0];

            $labelX = $itemX - $labelWidth / 2;
            $labelY = $gridBottom + $labelMargin + $fontSize;

            // Add bottom label: key
            imagettftext($chart, $fontSizeBig, 0, $labelX, $labelY, $labelColor, $fontBig, $key);

            // Add top labels: key, trait, score
            imagettftext($chart, $fontSizeBig, 0, $labelX, $yLegendKey, $labelColor, $fontBig, $key);
            imagettftext($chart, $fontSize, 0, ($labelX - $offset[$key]), $yLegendTrait, $labelColor, $font, $legend[$key]);
            $scoreStrLen = strlen(strval($score));
            imagettftext($chart, $fontSizeBig, 0, ($labelX - ($scoreStrLen - 1) * 6), $yLegendScore, $labelColor, $fontBig, $score);

            $itemX += $barSpacing;
        }

        // Draw right border line
        $lineX = $itemX - $barWidth - 20;
        imageline($chart, $lineX, 0, $lineX, $gridBottom, $axisColor);

        return $chart;
    }
}
