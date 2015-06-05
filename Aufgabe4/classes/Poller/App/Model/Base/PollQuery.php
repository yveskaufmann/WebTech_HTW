<?php

namespace Poller\App\Model\Base;

use \Exception;
use \PDO;
use Poller\App\Model\Poll as ChildPoll;
use Poller\App\Model\PollQuery as ChildPollQuery;
use Poller\App\Model\Map\PollTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Poll' table.
 *
 *
 *
 * @method     ChildPollQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPollQuery orderByQuestion($order = Criteria::ASC) Order by the question column
 *
 * @method     ChildPollQuery groupById() Group by the id column
 * @method     ChildPollQuery groupByQuestion() Group by the question column
 *
 * @method     ChildPollQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPollQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPollQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPollQuery leftJoinPollAnswer($relationAlias = null) Adds a LEFT JOIN clause to the query using the PollAnswer relation
 * @method     ChildPollQuery rightJoinPollAnswer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PollAnswer relation
 * @method     ChildPollQuery innerJoinPollAnswer($relationAlias = null) Adds a INNER JOIN clause to the query using the PollAnswer relation
 *
 * @method     \Poller\App\Model\PollAnswerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPoll findOne(ConnectionInterface $con = null) Return the first ChildPoll matching the query
 * @method     ChildPoll findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPoll matching the query, or a new ChildPoll object populated from the query conditions when no match is found
 *
 * @method     ChildPoll findOneById(string $id) Return the first ChildPoll filtered by the id column
 * @method     ChildPoll findOneByQuestion(string $question) Return the first ChildPoll filtered by the question column *

 * @method     ChildPoll requirePk($key, ConnectionInterface $con = null) Return the ChildPoll by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPoll requireOne(ConnectionInterface $con = null) Return the first ChildPoll matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPoll requireOneById(string $id) Return the first ChildPoll filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPoll requireOneByQuestion(string $question) Return the first ChildPoll filtered by the question column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPoll[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPoll objects based on current ModelCriteria
 * @method     ChildPoll[]|ObjectCollection findById(string $id) Return ChildPoll objects filtered by the id column
 * @method     ChildPoll[]|ObjectCollection findByQuestion(string $question) Return ChildPoll objects filtered by the question column
 * @method     ChildPoll[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PollQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Poller\App\Model\Base\PollQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'poller', $modelName = '\\Poller\\App\\Model\\Poll', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPollQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPollQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPollQuery) {
            return $criteria;
        }
        $query = new ChildPollQuery();
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
     * @return ChildPoll|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PollTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PollTableMap::DATABASE_NAME);
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
     * @return ChildPoll A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, question FROM Poll WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPoll $obj */
            $obj = new ChildPoll();
            $obj->hydrate($row);
            PollTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildPoll|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPollQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PollTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPollQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PollTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE id = 'fooValue'
     * $query->filterById('%fooValue%'); // WHERE id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $id The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPollQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $id)) {
                $id = str_replace('*', '%', $id);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PollTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the question column
     *
     * Example usage:
     * <code>
     * $query->filterByQuestion('fooValue');   // WHERE question = 'fooValue'
     * $query->filterByQuestion('%fooValue%'); // WHERE question LIKE '%fooValue%'
     * </code>
     *
     * @param     string $question The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPollQuery The current query, for fluid interface
     */
    public function filterByQuestion($question = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($question)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $question)) {
                $question = str_replace('*', '%', $question);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PollTableMap::COL_QUESTION, $question, $comparison);
    }

    /**
     * Filter the query by a related \Poller\App\Model\PollAnswer object
     *
     * @param \Poller\App\Model\PollAnswer|ObjectCollection $pollAnswer the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPollQuery The current query, for fluid interface
     */
    public function filterByPollAnswer($pollAnswer, $comparison = null)
    {
        if ($pollAnswer instanceof \Poller\App\Model\PollAnswer) {
            return $this
                ->addUsingAlias(PollTableMap::COL_ID, $pollAnswer->getPollId(), $comparison);
        } elseif ($pollAnswer instanceof ObjectCollection) {
            return $this
                ->usePollAnswerQuery()
                ->filterByPrimaryKeys($pollAnswer->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPollAnswer() only accepts arguments of type \Poller\App\Model\PollAnswer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PollAnswer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPollQuery The current query, for fluid interface
     */
    public function joinPollAnswer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PollAnswer');

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
            $this->addJoinObject($join, 'PollAnswer');
        }

        return $this;
    }

    /**
     * Use the PollAnswer relation PollAnswer object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Poller\App\Model\PollAnswerQuery A secondary query class using the current class as primary query
     */
    public function usePollAnswerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPollAnswer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PollAnswer', '\Poller\App\Model\PollAnswerQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPoll $poll Object to remove from the list of results
     *
     * @return $this|ChildPollQuery The current query, for fluid interface
     */
    public function prune($poll = null)
    {
        if ($poll) {
            $this->addUsingAlias(PollTableMap::COL_ID, $poll->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Poll table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PollTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PollTableMap::clearInstancePool();
            PollTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PollTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PollTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PollTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PollTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PollQuery
