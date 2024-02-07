<?php

namespace App;

/**
 * Class for Menu model
 */
class Menu
{
    private static \PDO $db;

    public function __construct(
        public ?int $id,
        public ?string $name,
        public ?string $description = null
    ) {
    }

    public static function setDbconnection(\PDO $db)
    {
        self::$db = $db;
    }

    /**
     * Returns one row from Menu table with specific id
     *
     * @param integer $id
     * @return Menu
     */
    public static function byId(int $id): Menu
    {
        $query = 'SELECT * FROM menu WHERE id=:id';

        $menu = self::$db->prepare($query);
        $menu->execute(['id' => $id]);
        $menu = $menu->fetch(\PDO::FETCH_ASSOC);

        return new Menu(
            $menu['id'],
            $menu['name'],
            $menu['description']
        );
    }

    /**
     * Returns array of all rows from Menu table
     *
     * @return array
     */
    public static function all(): array
    {
        $query = 'SELECT * FROM menu';

        try {
            $menus = self::$db->query($query);
            $menus = $menus->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }

        return array_map(function ($menu) {
            return new Menu($menu['id'], $menu['name'], $menu['description']);
        }, $menus);
    }
}
