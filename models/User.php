<?php

class User
{
    public int    $id;
    public string $first_name;
    public string $last_name;
    public string $address;
    public string $country;
    public string $gender;
    public string $skills;
    public string $username;
    public string $password;
    public string $department;
    public string $image;

    public static function fromArray(array $row): User
    {
        $user             = new self();
        $user->id         = (int)($row['id']         ?? 0);
        $user->first_name = $row['first_name']        ?? '';
        $user->last_name  = $row['last_name']         ?? '';
        $user->address    = $row['address']           ?? '';
        $user->country    = $row['country']           ?? '';
        $user->gender     = $row['gender']            ?? '';
        $user->skills     = $row['skills']            ?? '';
        $user->username   = $row['username']          ?? '';
        $user->password   = $row['password']          ?? '';
        $user->department = $row['department']        ?? '';
        $user->image      = $row['image']             ?? '';

        return $user;
    }

    public function skillsArray(): array
    {
        return $this->skills !== '' ? explode('-', $this->skills) : [];
    }
}
