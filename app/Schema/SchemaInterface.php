<?php

namespace MyPlugin\Schema;

interface SchemaInterface
{
	public function getSchemaType(): string;
	public function getDefaultMappings(): array;
	public function generateSchema(array $data): array;
}
