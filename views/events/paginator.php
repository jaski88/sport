<?php
use yii\data\Pagination;
use app\models\EventSearch;
?>

<div class="panel panel-default">
    <div class="panel-body">


        <?php
        $count = $dataProvider->getCount();
        if (($pagination = $dataProvider->getPagination()) !== false && $count != 0 ) {
            $totalCount = $dataProvider->getTotalCount();
            $begin = $pagination->getPage() * $pagination->pageSize + 1;
            $end = $begin + $count - 1;
            if ($begin > $end) {
                $begin = $end;
            }
            $page = $pagination->getPage() + 1;
            $pageCount = $pagination->pageCount;

            echo Yii::t('yii', 'Showing <b>{begin, number}-{end, number}</b> of <b>{totalCount, number}</b> {totalCount, plural, one{item} other{items}} <b>{page}</b>/<b>{pageCount}</b>.', [
                'begin' => $begin,
                'end' => $end,
                'count' => $count,
                'totalCount' => $totalCount,
                'page' => $page,
                'pageCount' => $pageCount,
            ]);

            $urls = $pagination->getLinks();
        ?>

        <a href="<?= @$urls[Pagination::LINK_PREV]; ?>" class="btn btn-sm btn-success glyphicon glyphicon-chevron-left <?= isset( $urls[Pagination::LINK_PREV] ) ? '' : 'disabled' ?>"></a>
        <a href="<?= @$urls[Pagination::LINK_NEXT]; ?>" class="btn btn-sm btn-success glyphicon glyphicon-chevron-right <?= isset( $urls[Pagination::LINK_NEXT] ) ? '' : 'disabled' ?>" ></a>
        
        <?php
        }else{
            echo "No results found.";
        }
        ?>

    </div>
</div>