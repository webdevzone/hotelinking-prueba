<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 23/04/2018
 * Time: 11:28
 */


?>

<div class="row">
    <div class="col">
        <h1><?=__('My Promotion codes')?></h1>

        <?php
        if (!empty($promotioncodes)) {
            ?>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Promotion Code</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Redeemed</th>
                    <th scope="col">Created</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($promotioncodes as $key => $val) {
                    if ($val['PromotionCode']['is_redeemed'] === false) {
                        $redeemed =  $this->Html->link(__('Redeem'),
                            ['controller' => 'promotion_codes', 'action' => 'redeem', $val['PromotionCode']['id']],
                            ['class' => 'btn btn-info']
                        );
                    } else {
                        $redeemed =  $val['PromotionCode']['redeemed'];
                    }

                    ?>
                    <tr>
                        <th scope="row"><?=$val['PromotionCode']['id']?></th>
                        <td><?=$val['PromotionCode']['title']?></td>
                        <td><?=$val['PromotionCode']['token']?></td>
                        <td><?=$val['PromotionCode']['discount'].'%'?></td>
                        <td><?=$redeemed?></td>
                        <td><?=$val['PromotionCode']['created']?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>

            <?php
        } else {
            echo '<div class="alert alert-info">'.__('Currently, you don\'t have any promotion codes ').'</div>';
        }
        ?>
    </div>
</div>
