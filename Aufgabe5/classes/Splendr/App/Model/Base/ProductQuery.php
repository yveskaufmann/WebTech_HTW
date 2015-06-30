<?php

namespace Splendr\App\Model\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Splendr\App\Model\Product as ChildProduct;
use Splendr\App\Model\ProductQuery as ChildProductQuery;
use Splendr\App\Model\Map\ProductTableMap;

/**
 * Base class that represents a query for the 'Product' table.
 *
 *
 *
 * @method     ChildProductQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProductQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildProductQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildProductQuery orderByImageUrl($order = Criteria::ASC) Order by the image_url column
 * @method     ChildProductQuery orderByProductUrl($order = Criteria::ASC) Order by the product_url column
 * @method     ChildProductQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildProductQuery orderByBoardId($order = Criteria::ASC) Order by the board_id column
 *
 * @method     ChildProductQuery groupById() Group by the id column
 * @method     ChildProductQuery groupByName() Group by the name column
 * @method     ChildProductQuery groupByPrice() Group by the price column
 * @method     ChildProductQuery groupByImageUrl() Group by the image_url column
 * @method     ChildProductQuery groupByProductUrl() Group by the product_url column
 * @method     ChildProductQuery groupByDescription() Group by the description column
 * @method     ChildProductQuery groupByBoardId() Group by the board_id column
 *
 * @method     ChildProductQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductQuery leftJoinProductBoard($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductBoard relation
 * @method     ChildProductQuery rightJoinProductBoard($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductBoard relation
 * @method     ChildProductQuery innerJoinProductBoard($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductBoard relation
 *
 * @method     ChildProductQuery leftJoinProductReview($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductReview relation
 * @method     ChildProductQuery rightJoinProductReview($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductReview relation
 * @method     ChildProductQuery innerJoinProductReview($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductReview relation
 *
 * @method     \Splendr\App\Model\ProductBoardQuery|\Splendr\App\Model\ProductReviewQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProduct findOne(ConnectionInterface $con = null) Return the first ChildProduct matching the query
 * @method     ChildProduct findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProduct matching the query, or a new ChildProduct object populated from the query conditions when no match is found
 *
 * @method     ChildProduct findOneById(int $id) Return the first ChildProduct filtered by the id column
 * @method     ChildProduct findOneByName(string $name) Return the first ChildProduct filtered by the name column
 * @method     ChildProduct findOneByPrice(string $price) Return the first ChildProduct filtered by the price column
 * @method     ChildProduct findOneByImageUrl(string $image_url) Return the first ChildProduct filtered by the image_url column
 * @method     ChildProduct findOneByProductUrl(string $product_url) Return the first ChildProduct filtered by the product_url column
 * @method     ChildProduct findOneByDescription(string $description) Return the first ChildProduct filtered by the description column
 * @method     ChildProduct findOneByBoardId(int $board_id) Return the first ChildProduct filtered by the board_id column *

 * @method     ChildProduct requirePk($key, ConnectionInterface $con = null) Return the ChildProduct by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOne(ConnectionInterface $con = null) Return the first ChildProduct matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduct requireOneById(int $id) Return the first ChildProduct filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByName(string $name) Return the first ChildProduct filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByPrice(string $price) Return the first ChildProduct filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByImageUrl(string $image_url) Return the first ChildProduct filtered by the image_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByProductUrl(string $product_url) Return the first ChildProduct filtered by the product_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByDescription(string $description) Return the first ChildProduct filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByBoardId(int $board_id) Return the first ChildProduct filtered by the board_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduct[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProduct objects based on current ModelCriteria
 * @method     ChildProduct[]|ObjectCollection findById(int $id) Return ChildProduct objects filtered by the id column
 * @method     ChildProduct[]|ObjectCollection findByName(string $name) Return ChildProduct objects filtered by the name column
 * @method     ChildProduct[]|ObjectCollection findByPrice(string $price) Return ChildProduct objects filtered by the price column
 * @method     ChildProduct[]|ObjectCollection findByImageUrl(string $image_url) Return ChildProduct objects filtered by the image_url column
 * @method     ChildProduct[]|ObjectCollection findByProductUrl(string $product_url) Return ChildProduct objects filtered by the product_url column
 * @method     ChildProduct[]|ObjectCollection findByDescription(string $description) Return ChildProduct objects filtered by the description column
 * @method     ChildProduct[]|ObjectCollection findByBoardId(int $board_id) Return ChildProduct objects filtered by the board_id column
 * @method     ChildProduct[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Splendr\App\Model\Base\ProductQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'splendr', $modelName = '\\Splendr\\App\\Model\\Product', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductQuery) {
            return $criteria;
        }
        $query = new ChildProductQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildProduct|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProductTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProduct A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, price, image_url, product_url, description, board_id FROM Product WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildProduct $obj */
            $obj = new ChildProduct();
            $obj->hydrate($row);
            ProductTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildProduct|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProductTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProductTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE price = 1234
     * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
     * $query->filterByPrice(array('min' => 12)); // WHERE price > 12
     * </code>
     *
     * @param     mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRICE, $price, $comparison);
    }

    /**
     * Filter the query on the image_url column
     *
     * Example usage:
     * <code>
     * $query->filterByImageUrl('fooValue');   // WHERE image_url = 'fooValue'
     * $query->filterByImageUrl('%fooValue%'); // WHERE image_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByImageUrl($imageUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageUrl)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imageUrl)) {
                $imageUrl = str_replace('*', '%', $imageUrl);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_IMAGE_URL, $imageUrl, $comparison);
    }

    /**
     * Filter the query on the product_url column
     *
     * Example usage:
     * <code>
     * $query->filterByProductUrl('fooValue');   // WHERE product_url = 'fooValue'
     * $query->filterByProductUrl('%fooValue%'); // WHERE product_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductUrl($productUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productUrl)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $productUrl)) {
                $productUrl = str_replace('*', '%', $productUrl);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_URL, $productUrl, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the board_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBoardId(1234); // WHERE board_id = 1234
     * $query->filterByBoardId(array(12, 34)); // WHERE board_id IN (12, 34)
     * $query->filterByBoardId(array('min' => 12)); // WHERE board_id > 12
     * </code>
     *
     * @see       filterByProductBoard()
     *
     * @param     mixed $boardId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByBoardId($boardId = null, $comparison = null)
    {
        if (is_array($boardId)) {
            $useMinMax = false;
            if (isset($boardId['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_BOARD_ID, $boardId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($boardId['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_BOARD_ID, $boardId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_BOARD_ID, $boardId, $comparison);
    }

    /**
     * Filter the query by a related \Splendr\App\Model\ProductBoard object
     *
     * @param \Splendr\App\Model\ProductBoard|ObjectCollection $productBoard The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductBoard($productBoard, $comparison = null)
    {
        if ($productBoard instanceof \Splendr\App\Model\ProductBoard) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_BOARD_ID, $productBoard->getId(), $comparison);
        } elseif ($productBoard instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductTableMap::COL_BOARD_ID, $productBoard->toKeyValue('Id', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProductBoard() only accepts arguments of type \Splendr\App\Model\ProductBoard or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductBoard relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProductBoard($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductBoard');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProductBoard');
        }

        return $this;
    }

    /**
     * Use the ProductBoard relation ProductBoard object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Splendr\App\Model\ProductBoardQuery A secondary query class using the current class as primary query
     */
    public function useProductBoardQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductBoard($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductBoard', '\Splendr\App\Model\ProductBoardQuery');
    }

    /**
     * Filter the query by a related \Splendr\App\Model\ProductReview object
     *
     * @param \Splendr\App\Model\ProductReview|ObjectCollection $productReview the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductReview($productReview, $comparison = null)
    {
        if ($productReview instanceof \Splendr\App\Model\ProductReview) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_ID, $productReview->getProductId(), $comparison);
        } elseif ($productReview instanceof ObjectCollection) {
            return $this
                ->useProductReviewQuery()
                ->filterByPrimaryKeys($productReview->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductReview() only accepts arguments of type \Splendr\App\Model\ProductReview or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductReview relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProductReview($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductReview');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProductReview');
        }

        return $this;
    }

    /**
     * Use the ProductReview relation ProductReview object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Splendr\App\Model\ProductReviewQuery A secondary query class using the current class as primary query
     */
    public function useProductReviewQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductReview($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductReview', '\Splendr\App\Model\ProductReviewQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProduct $product Object to remove from the list of results
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function prune($product = null)
    {
        if ($product) {
            $this->addUsingAlias(ProductTableMap::COL_ID, $product->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductTableMap::clearInstancePool();
            ProductTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProductQuery
