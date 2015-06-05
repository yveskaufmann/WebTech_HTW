<?php

namespace Poller\App\Model\Base;

use \Exception;
use \PDO;
use Poller\App\Model\PollAnswer as ChildPollAnswer;
use Poller\App\Model\PollAnswerQuery as ChildPollAnswerQuery;
use Poller\App\Model\Map\PollAnswerTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Poll_Answer' table.
 *
 *
 *
 * @method     ChildPollAnswerQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPollAnswerQuery orderByPollId($order = Criteria::ASC) Order by the poll column
 * @method     ChildPollAnswerQuery orderByText($order = Criteria::ASC) Order by the text column
 * @method     ChildPollAnswerQuery orderByVotes($order = Criteria::ASC) Order by the votes column
 *
 * @method     ChildPollAnswerQuery groupById() Group by the id column
 * @method     ChildPollAnswerQuery groupByPollId() Group by the poll column
 * @method     ChildPollAnswerQuery groupByText() Group by the text column
 * @method     ChildPollAnswerQuery groupByVotes() Group by the votes column
 *
 * @method     ChildPollAnswerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPollAnswerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPollAnswerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPollAnswerQuery leftJoinPoll($relationAlias = null) Adds a LEFT JOIN clause to the query using the Poll relation
 * @method     ChildPollAnswerQuery rightJoinPoll($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Poll relation
 * @method     ChildPollAnswerQuery innerJoinPoll($relationAlias = null) Adds a INNER JOIN clause to the query using the Poll relation
 *
 * @method     \Poller\App\Model\PollQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPollAnswer findOne(ConnectionInterface $con = null) Return the first ChildPollAnswer matching the query
 * @method     ChildPollAnswer findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPollAnswer matching the query, or a new ChildPollAnswer object populated from the query conditions when no match is found
 *
 * @method     ChildPollAnswer findOneById(int $id) Return the first ChildPollAnswer filtered by the id column
 * @method     ChildPollAnswer findOneByPollId(string $poll) Return the first ChildPollAnswer filtered by the poll column
 * @method     ChildPollAnswer findOneByText(string $text) Return the first ChildPollAnswer filtered by the text column
 * @method     ChildPollAnswer findOneByVotes(int $votes) Return the first ChildPollAnswer filtered by the votes column *

 * @method     ChildPollAnswer requirePk($key, ConnectionInterface $con = null) Return the ChildPollAnswer by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPollAnswer requireOne(ConnectionInterface $con = null) Return the first ChildPollAnswer matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPollAnswer requireOneById(int $id) Return the first ChildPollAnswer filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPollAnswer requireOneByPollId(string $poll) Return the first ChildPollAnswer filtered by the poll column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPollAnswer requireOneByText(string $text) Return the first ChildPollAnswer filtered by the text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPollAnswer requireOneByVotes(int $votes) Return the first ChildPollAnswer filtered by the votes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPollAnswer[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPollAnswer objects based on current ModelCriteria
 * @method     ChildPollAnswer[]|ObjectCollection findById(int $id) Return ChildPollAnswer objects filtered by the id column
 * @method     ChildPollAnswer[]|ObjectCollection findByPollId(string $poll) Return ChildPollAnswer objects filtered by the poll column
 * @method     ChildPollAnswer[]|ObjectCollection findByText(string $text) Return ChildPollAnswer objects filtered by the text column
 * @method     ChildPollAnswer[]|ObjectCollection findByVotes(int $votes) Return ChildPollAnswer objects filtered by the votes column
 * @method     ChildPollAnswer[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PollAnswerQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Poller\App\Model\Base\PollAnswerQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'poller', $modelName = '\\Poller\\App\\Model\\PollAnswer', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPollAnswerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPollAnswerQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPollAnswerQuery) {
            return $criteria;
        }
        $query = new ChildPollAnswerQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $poll] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPollAnswer|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PollAnswerTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PollAnswerTableMap::DATABASE_NAME);
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
     * @return ChildPollAnswer A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, poll, text, votes FROM Poll_Answer WHERE id = :p0 AND poll = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPollAnswer $obj */
            $obj = new ChildPollAnswer();
            $obj->hydrate($row);
            PollAnswerTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildPollAnswer|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildPollAnswerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PollAnswerTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PollAnswerTableMap::COL_POLL, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPollAnswerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PollAnswerTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PollAnswerTableMap::COL_POLL, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildPollAnswerQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PollAnswerTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PollAnswerTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PollAnswerTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the poll column
     *
     * Example usage:
     * <code>
     * $query->filterByPollId('fooValue');   // WHERE poll = 'fooValue'
     * $query->filterByPollId('%fooValue%'); // WHERE poll LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pollId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPollAnswerQuery The current query, for fluid interface
     */
    public function filterByPollId($pollId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pollId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pollId)) {
                $pollId = str_replace('*', '%', $pollId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PollAnswerTableMap::COL_POLL, $pollId, $comparison);
    }

    /**
     * Filter the query on the text column
     *
     * Example usage:
     * <code>
     * $query->filterByText('fooValue');   // WHERE text = 'fooValue'
     * $query->filterByText('%fooValue%'); // WHERE text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $text The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPollAnswerQuery The current query, for fluid interface
     */
    public function filterByText($text = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($text)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $text)) {
                $text = str_replace('*', '%', $text);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PollAnswerTableMap::COL_TEXT, $text, $comparison);
    }

    /**
     * Filter the query on the votes column
     *
     * Example usage:
     * <code>
     * $query->filterByVotes(1234); // WHERE votes = 1234
     * $query->filterByVotes(array(12, 34)); // WHERE votes IN (12, 34)
     * $query->filterByVotes(array('min' => 12)); // WHERE votes > 12
     * </code>
     *
     * @param     mixed $votes The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPollAnswerQuery The current query, for fluid interface
     */
    public function filterByVotes($votes = null, $comparison = null)
    {
        if (is_array($votes)) {
            $useMinMax = false;
            if (isset($votes['min'])) {
                $this->addUsingAlias(PollAnswerTableMap::COL_VOTES, $votes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($votes['max'])) {
                $this->addUsingAlias(PollAnswerTableMap::COL_VOTES, $votes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PollAnswerTableMap::COL_VOTES, $votes, $comparison);
    }

    /**
     * Filter the query by a related \Poller\App\Model\Poll object
     *
     * @param \Poller\App\Model\Poll|ObjectCollection $poll The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPollAnswerQuery The current query, for fluid interface
     */
    public function filterByPoll($poll, $comparison = null)
    {
        if ($poll instanceof \Poller\App\Model\Poll) {
            return $this
                ->addUsingAlias(PollAnswerTableMap::COL_POLL, $poll->getId(), $comparison);
        } elseif ($poll instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PollAnswerTableMap::COL_POLL, $poll->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPoll() only accepts arguments of type \Poller\App\Model\Poll or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Poll relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPollAnswerQuery The current query, for fluid interface
     */
    public function joinPoll($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Poll');

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
            $this->addJoinObject($join, 'Poll');
        }

        return $this;
    }

    /**
     * Use the Poll relation Poll object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Poller\App\Model\PollQuery A secondary query class using the current class as primary query
     */
    public function usePollQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPoll($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Poll', '\Poller\App\Model\PollQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPollAnswer $pollAnswer Object to remove from the list of results
     *
     * @return $this|ChildPollAnswerQuery The current query, for fluid interface
     */
    public function prune($pollAnswer = null)
    {
        if ($pollAnswer) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PollAnswerTableMap::COL_ID), $pollAnswer->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PollAnswerTableMap::COL_POLL), $pollAnswer->getPollId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Poll_Answer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PollAnswerTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PollAnswerTableMap::clearInstancePool();
            PollAnswerTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PollAnswerTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PollAnswerTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PollAnswerTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PollAnswerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PollAnswerQuery
