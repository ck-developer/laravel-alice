<?php

namespace Ck\Laravel\Alice\Persister;

use Ck\Laravel\Alice\Test\Model\User;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Nelmio\Alice\PersisterInterface;

class EloquentPersister implements PersisterInterface
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Persists objects into the database.
     *
     * @param Model[] $models
     */
    public function persist(array $models)
    {
        $this->connection->beginTransaction();

        foreach ($models as $model) {

            if (!$model instanceof Model) {
                $this->connection->rollBack();
            }

            $model->save();
        }

        $this->connection->commit();
    }

    /**
     * Finds an object by class and id.
     *
     * @param string $class
     * @param int $id
     *
     * @return object|null
     */
    public function find($class, $id)
    {
        return $class::findOrFail($id);
    }
}
