<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 22/04/2018
 * Time: 23:28
 */
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Hotelinking - prueba</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>

            <?php
            $actLink = "";
            $lCount = count($items['usermenu']);
            $x = 1;
            foreach ($items['usermenu'] as $key => $item) {
                $last = ($x == $lCount) ? 'last' : '';
                $params = array('escape' => false, 'class' =>$item['class']);
                if (!empty($item['title'])) {
                    $params['title'] = $item['title'];
                }
                echo '<li class="'.$actLink.' '.$last.'">';
                echo $this->Html->link($item['label'], $item['url'], $params);
                echo '</li>';
                $x++;
            }

            ?>
        </ul>
    </div>
</nav>
