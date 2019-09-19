<?php
interface Repository
{
    public function all(): array;

    public function store(array $payload): array;

    public function update(int $id, array $payload): array;

    
}
