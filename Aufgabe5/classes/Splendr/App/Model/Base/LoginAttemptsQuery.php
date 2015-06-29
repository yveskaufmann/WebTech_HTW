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
use Splendr\App\Model\LoginAttempts as ChildLoginAttempts;
use Splendr\App\Model\LoginAttemptsQuery as ChildLoginAttemptsQuery;
use Splendr\App\Model\Map\LoginAttemptsTableMap;

/**
 * Base class that represents a query for the 'LoginAttempts' table.
 *
 *
 *
 * @method     ChildLoginAttemptsQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildLoginAttemptsQuery orderBySuccessfulLogins($order = Criteria::ASC) Order by the successful_logins column
 * @method     ChildLoginAttemptsQuery orderByFailedLogins($order = Criteria::ASC) Order by the failed_logins column
 * @method     ChildLoginAttemptsQuery orderByLastLogin($order = Criteria::ASC) Order by the last_login column
 *
 * @method     ChildLoginAttemptsQuery groupByUserId() Group by the user_id column
 * @method     ChildLoginAttemptsQuery groupBySuccessfulLogins() Group by the successful_logins column
 * @method     ChildLoginAttemptsQuery groupByFailedLogins() Group by the failed_logins column
 * @method     ChildLoginAttemptsQuery groupByLastLogin() Group by the last_login column
 *
 * @method     ChildLoginAttemptsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLoginAttemptsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLoginAttemptsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLoginAttemptsQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildLoginAttemptsQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildLoginAttemptsQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     \Splendr\App\Model\UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLoginAttempts findOne(ConnectionInterface $con = null) Return the first ChildLoginAttempts matching the query
 * @method     ChildLoginAttempts findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLoginAttempts matching the query, or a new ChildLoginAttempts object populated from the query conditions when no match is found
 *
 * @method     ChildLoginAttempts findOneByUserId(int $user_id) Return the first ChildLoginAttempts filtered by the user_id column
 * @method     ChildLoginAttempts findOneBySuccessfulLogins(int $successful_logins) Return the first ChildLoginAttempts filtered by the successful_logins column
 * @method     ChildLoginAttempts findOneByFailedLogins(int $failed_logins) Return the first ChildLoginAttempts filtered by the failed_logins column
 * @method     ChildLoginAttempts findOneByLastLogin(string $last_login) Return the first ChildLoginAttempts filtered by the last_login column *

 * @method     ChildLoginAttempts requirePk($key, ConnectionInterface $con = null) Return the ChildLoginAttempts by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAttempts requireOne(ConnectionInterface $con = null) Return the first ChildLoginAttempts matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLoginAttempts requireOneByUserId(int $user_id) Return the first ChildLoginAttempts filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAttempts requireOneBySuccessfulLogins(int $successful_logins) Return the first ChildLoginAttempts filtered by the successful_logins column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAttempts requireOneByFailedLogins(int $failed_logins) Return the first ChildLoginAttempts filtered by the failed_logins column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLoginAttempts requireOneByLastLogin(string $last_login) Return the first ChildLoginAttempts filtered by the last_login column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLoginAttempts[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLoginAttempts objects based on current ModelCriteria
 * @method     ChildLoginAttempts[]|ObjectCollection findByUserId(int $user_id) Return ChildLoginAttempts objects filtered by the user_id column
 * @method     ChildLoginAttempts[]|ObjectCollection findBySuccessfulLogins(int $successful_logins) Return ChildLoginAttempts objects filtered by the successful_logins column
 * @method     ChildLoginAttempts[]|ObjectCollection findByFailedLogins(int $failed_logins) Return ChildLoginAttempts objects filtered by the failed_logins column
 * @method     ChildLoginAttempts[]|ObjectCollection findByLastLogin(string $last_login) Return ChildLoginAttempts objects filtered by the last_login column
 * @method     ChildLoginAttempts[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LoginAttemptsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Splendr\App\Model\Base\LoginAttemptsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'splendr', $modelName = '\\Splendr\\App\\Model\\LoginAttempts', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLoginAttemptsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLoginAttemptsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLoginAttemptsQuery) {
            return $criteria;
        }
        $query = new ChildLoginAttemptsQuery();
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
     * @return ChildLoginAttempts|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LoginAttemptsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LoginAttemptsTableMap::DATABASE_NAME);
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
     * @return ChildLoginAttempts A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT user_id, successful_logins, failed_logins, last_login FROM LoginAttempts WHERE user_id = :p0';
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
            /** @var ChildLoginAttempts $obj */
            $obj = new ChildLoginAttempts();
            $obj->hydrate($row);
            LoginAttemptsTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildLoginAttempts|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLoginAttemptsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LoginAttemptsTableMap::COL_USER_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLoginAttemptsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LoginAttemptsTableMap::COL_USER_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginAttemptsQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(LoginAttemptsTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(LoginAttemptsTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginAttemptsTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the successful_logins column
     *
     * Example usage:
     * <code>
     * $query->filterBySuccessfulLogins(1234); // WHERE successful_logins = 1234
     * $query->filterBySuccessfulLogins(array(12, 34)); // WHERE successful_logins IN (12, 34)
     * $query->filterBySuccessfulLogins(array('min' => 12)); // WHERE successful_logins > 12
     * </code>
     *
     * @param     mixed $successfulLogins The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginAttemptsQuery The current query, for fluid interface
     */
    public function filterBySuccessfulLogins($successfulLogins = null, $comparison = null)
    {
        if (is_array($successfulLogins)) {
            $useMinMax = false;
            if (isset($successfulLogins['min'])) {
                $this->addUsingAlias(LoginAttemptsTableMap::COL_SUCCESSFUL_LOGINS, $successfulLogins['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($successfulLogins['max'])) {
                $this->addUsingAlias(LoginAttemptsTableMap::COL_SUCCESSFUL_LOGINS, $successfulLogins['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginAttemptsTableMap::COL_SUCCESSFUL_LOGINS, $successfulLogins, $comparison);
    }

    /**
     * Filter the query on the failed_logins column
     *
     * Example usage:
     * <code>
     * $query->filterByFailedLogins(1234); // WHERE failed_logins = 1234
     * $query->filterByFailedLogins(array(12, 34)); // WHERE failed_logins IN (12, 34)
     * $query->filterByFailedLogins(array('min' => 12)); // WHERE failed_logins > 12
     * </code>
     *
     * @param     mixed $failedLogins The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginAttemptsQuery The current query, for fluid interface
     */
    public function filterByFailedLogins($failedLogins = null, $comparison = null)
    {
        if (is_array($failedLogins)) {
            $useMinMax = false;
            if (isset($failedLogins['min'])) {
                $this->addUsingAlias(LoginAttemptsTableMap::COL_FAILED_LOGINS, $failedLogins['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($failedLogins['max'])) {
                $this->addUsingAlias(LoginAttemptsTableMap::COL_FAILED_LOGINS, $failedLogins['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginAttemptsTableMap::COL_FAILED_LOGINS, $failedLogins, $comparison);
    }

    /**
     * Filter the query on the last_login column
     *
     * Example usage:
     * <code>
     * $query->filterByLastLogin('2011-03-14'); // WHERE last_login = '2011-03-14'
     * $query->filterByLastLogin('now'); // WHERE last_login = '2011-03-14'
     * $query->filterByLastLogin(array('max' => 'yesterday')); // WHERE last_login > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastLogin The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLoginAttemptsQuery The current query, for fluid interface
     */
    public function filterByLastLogin($lastLogin = null, $comparison = null)
    {
        if (is_array($lastLogin)) {
            $useMinMax = false;
            if (isset($lastLogin['min'])) {
                $this->addUsingAlias(LoginAttemptsTableMap::COL_LAST_LOGIN, $lastLogin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastLogin['max'])) {
                $this->addUsingAlias(LoginAttemptsTableMap::COL_LAST_LOGIN, $lastLogin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LoginAttemptsTableMap::COL_LAST_LOGIN, $lastLogin, $comparison);
    }

    /**
     * Filter the query by a related \Splendr\App\Model\User object
     *
     * @param \Splendr\App\Model\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLoginAttemptsQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \Splendr\App\Model\User) {
            return $this
                ->addUsingAlias(LoginAttemptsTableMap::COL_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LoginAttemptsTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \Splendr\App\Model\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLoginAttemptsQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Splendr\App\Model\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\Splendr\App\Model\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLoginAttempts $loginAttempts Object to remove from the list of results
     *
     * @return $this|ChildLoginAttemptsQuery The current query, for fluid interface
     */
    public function prune($loginAttempts = null)
    {
        if ($loginAttempts) {
            $this->addUsingAlias(LoginAttemptsTableMap::COL_USER_ID, $loginAttempts->getUserId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the LoginAttempts table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LoginAttemptsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LoginAttemptsTableMap::clearInstancePool();
            LoginAttemptsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LoginAttemptsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LoginAttemptsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LoginAttemptsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LoginAttemptsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LoginAttemptsQuery
