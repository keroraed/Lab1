<?php

class UserRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM users ORDER BY id DESC');
        return array_map([User::class, 'fromArray'], $stmt->fetchAll());
    }

    public function findById(int $id): ?User
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        return $row ? User::fromArray($row) : null;
    }

    public function findByUsername(string $username): ?User
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $row = $stmt->fetch();

        return $row ? User::fromArray($row) : null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            'INSERT INTO users
             (first_name, last_name, address, country, gender, skills, username, password, department, image)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
        );

        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['address'],
            $data['country'],
            $data['gender'],
            $data['skills'],
            $data['username'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['department'],
            $data['image'] ?? '',
        ]);
    }

    public function update(int $id, array $data): bool
    {
        if (!empty($data['password'])) {
            $stmt = $this->db->prepare(
                'UPDATE users
                 SET first_name=?, last_name=?, address=?, country=?, gender=?,
                     skills=?, username=?, password=?, department=?
                 WHERE id=?'
            );
            return $stmt->execute([
                $data['first_name'],
                $data['last_name'],
                $data['address'],
                $data['country'],
                $data['gender'],
                $data['skills'],
                $data['username'],
                password_hash($data['password'], PASSWORD_DEFAULT),
                $data['department'],
                $id,
            ]);
        }

        $stmt = $this->db->prepare(
            'UPDATE users
             SET first_name=?, last_name=?, address=?, country=?, gender=?,
                 skills=?, username=?, department=?
             WHERE id=?'
        );
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['address'],
            $data['country'],
            $data['gender'],
            $data['skills'],
            $data['username'],
            $data['department'],
            $id,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
