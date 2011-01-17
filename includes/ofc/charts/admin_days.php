<?php
/**
 * Copyright (c) 2010-2011 CodeHave (http://www.codehave.com/), All Rights Reserved
 * A CodeHill Creation (http://www.codehill.com/)
 * 
 * IMPORTANT: 
 * - You may not redistribute, sell or otherwise share this software in whole or in part without
 *   the consent of CodeHave's owners. Please contact the author for more information.
 * 
 * - Link to codehave.com may not be removed from the software pages without permission of CodeHave's
 *   owners. This copyright notice may not be removed from the source code in any case.
 *
 * - This file can be used, modified and distributed under the terms of the License Agreement. You
 *   may edit this file on a licensed Web site and/or for private development. You must adhere to
 *   the Source License Agreement. The latest copy can be found online at:
 * 
 *   http://www.codehave.com/license/
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR 
 * IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND 
 * FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR 
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, 
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY
 * WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @link        http://www.codehave.com/
 * @copyright   2010-2011 CodeHill LLC (http://www.codehill.com/)
 * @license     http://www.codehave.com/license/
 * @author      Amgad Suliman, CodeHill LLC <amgadhs@codehill.com>
 * @version     2.2
 *
 *
 * This page creates the JSON text needed to display the Days chart in admin/index.php
 *
 */
 
include("../open-flash-chart.php");

$title = new title("Past 30 Days");

//create teh line chart and set the values
$values = array(1,2,3,2,3,6,7,8,9,2,4,1,6,8,4,2,6,8,9,5,3,1,5,9,0,12,4,7,8,4,9,9,9);
$line = new line();
$line->set_values($values);
$line->set_colour("1111ff");

//create a Y Axis object and set the minimum and maximum
$ymax = (max($values)) + (10 - (max($values) % 10));  //round the maximum to the nearest 10
$y = new y_axis();
$y->set_range( 0, $ymax, $ymax/5);
$y->set_grid_colour("dddddd");
$y->set_colour("000000");

//create an X Axis object
$x = new x_axis();
$x->set_grid_colour("dddddd");
$x->set_colour("000000");

$chart = new open_flash_chart();
$chart->set_title($title);
$chart->add_element($line);
$chart->set_bg_colour("ffffff");
$chart->set_y_axis($y);
$chart->set_x_axis($x);

echo $chart->toString();   //print out the above parameters in JSON

?>