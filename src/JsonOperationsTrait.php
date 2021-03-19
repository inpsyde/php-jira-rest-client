<?php

namespace JiraRestApi;

use Exception;
use JsonMapper;

trait JsonOperationsTrait
{
    /**
     * @param mixed $data
     * @return string
     * @throws Exception When cannot encode the given data (JsonException if PHP 7.3+).
     */
    protected function encodeJson($data): string
    {
        $ret = json_encode($data, $this->getJsonOptions());
        if ($ret === false) {
            throw new Exception('Failed to encode JSON.');
        }
        return $ret;
    }

    /**
     * @param string $json
     * @return mixed
     * @throws Exception When cannot decode the given string (JsonException if PHP 7.3+).
     */
    protected function decodeJson(string $json)
    {
        $ret = json_decode($json, false, 512, $this->getJsonOptions());
        if ($ret === null) {
            throw new Exception('Failed to decode JSON.');
        }
        return $ret;
    }

    protected function prepareJsonMapper(array $classMap = []): JsonMapper
    {
        $mapper = $this->json_mapper;
        assert($mapper instanceof JsonMapper);

        $mapper->classMap = array_merge($mapper->classMap, $classMap);

        return $mapper;
    }
}
