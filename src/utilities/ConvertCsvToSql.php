<?php
declare(strict_types=1);

namespace Taskforce\utilities;

use SplFileObject;
use Taskforce\exceptions\FileFormatException;
use Taskforce\exceptions\SourceFileException;
use Taskforce\exceptions\WriteFileException;

class ConvertCsvToSql
{
    private $dirSqlName;
    private $filename;
    private $columns;
    private $fileCsv;
    private $fileSql;
    private $result = [];

    /**
        * ConvertCsvToSql constructor.
        * @param $filename
        * @param $columns
        * @param $dirSqlName
        */
    public function __construct(string $filename, array $columns, string $dirSqlName = 'queries')
    {
        $this->filename = $filename;
        $this->columns = $columns;
        $this->dirSqlName = $dirSqlName;
    }

    public function convert(): void
    {
        if (!$this->validateColumns($this->columns)) {
            throw new FileFormatException('Заданы неверные заголовки столбцов');
        }

        if (!file_exists($this->filename)) {
            throw new SourceFileException('Файл не существует');
        }

        try {
            $this->fileCsv = new SplFileObject($this->filename);
        }
        catch (RuntimeException $exception) {
            throw new SourceFileException('Не удалось открыть файл на чтение');
        }

        $header_data = $this->getHeaderData();

        if ($header_data !== $this->columns) {
            throw new FileFormatException('Исходный файл не содержит необходимых столбцов');
        }

        try {
            if (!file_exists($this->dirSqlName)) {
                mkdir($this->dirSqlName);
            }
        }
        catch (RuntimeException $exception) {
            throw new SourceFileException('Не удалось создать директорию');
        }

        $nameTable = $this->getNameTable();
        $nameRowsTable = $this->getNameRows();

        try {
            $this->fileSql = new SplFileObject("queries/$nameTable.sql", 'w');
        }
        catch (RuntimeException $exception) {
            throw new WriteFileException('Не удалось создать или записать в файл');
        }

        foreach ($this->getNextLine() as $line) {
            $this->result[] = $line;
            $valuesTable = "(" . implode(', ',
                array_map(function($item) {
                    return "'{$item}'";
                },
                $line)) . ")";
            if ($valuesTable !== "('')") {
                $this->writeSqlFile("INSERT INTO $nameTable ($nameRowsTable) VALUES $valuesTable;" . "\n");
            }
        }
    }

    public function getData(): array {
        return $this->result;
    }

    public function getNameRows(): string {
        return implode(', ',
            array_map(function($item) {
                return "`{$item}`";
            },
            $this->getHeaderData()));
    }

    public function getNameTable(): string {
        return $this->fileCsv->getBasename('.csv');
    }

    private function createSqlValues(array $values): ?string {
        $sqlValues = null;

        return $sqlValues;
    }

    private function writeSqlFile(string $sqlValues): void {
        $this->fileSql->fwrite($sqlValues);
    }

    private function getHeaderData(): ?array {
        $this->fileCsv->rewind();
        $data = $this->fileCsv->fgetcsv();

        return $data;
    }

    private function getNextLine(): ?iterable {
        $result = null;

        while (!$this->fileCsv->eof()) {
            yield $this->fileCsv->fgetcsv();
        }

        return $result;
    }

    private function validateColumns(array $columns): bool
    {
        $result = true;

        if (count($columns)) {
            foreach ($columns as $column) {
                if (!is_string($column)) {
                    $result = false;
                }
            }
        }
        else {
            $result = false;
        }

        return $result;
    }
}
