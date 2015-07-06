<?php

    use Splendr\Core\Helper\Pagination;
    $paginationCollection = $this->getData(Pagination::PAGINATION_PARAM);
    $baseURL = $this->getData(Pagination::BASE_URL_PARAM);

    $prepareURL = function($page) use($baseURL) {
        return str_replace(Pagination::PAGE_PLACEHOLDER, strval($page), $baseURL);
    }
?>

<?php if ($paginationCollection->haveToPaginate()): ?>
    <nav class="col-md-offset-6 col-md-12">
        <ul class="pagination">
            <li class=<?=($paginationCollection->isFirstPage() ? "disabled" : "")?>>
                <a href="<?= $prepareURL($paginationCollection->getPreviousPage()) ?>" aria-label="Zurück">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php foreach($paginationCollection->getLinks() as $pageNumber): ?>
                <li class="<?= ($pageNumber == $paginationCollection->getPage() ? "active" : "") ?>" >
                    <a href="<?= $prepareURL($pageNumber)?>"><?= $pageNumber?></a>
                </li>
            <?php endforeach; ?>

            <li class=<?=($paginationCollection->isLastPage() ? "disabled" : "")?>>
                <a href="<?= $prepareURL($paginationCollection->getNextPage()) ?>" aria-label="Weiter">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
<?php endif; ?>