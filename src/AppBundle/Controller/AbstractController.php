<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use League\Tactician\CommandBus;

class AbstractController extends FOSRestController
{

    const COMMAND_BUS_TRANSACTIONAL = 'tactician.commandbus.transactional';

    const COMMAND_BUS_NON_TRANSACTIONAL = 'tactician.commandbus';

    const COMMAND_BUS_QUEUED = 'tactician.commandbus.queued';

    const PAGINATOR_PER_PAGE_DEFAULT = 20;

    /**
     * @param null $data
     * @param bool|null $success
     * @param string|null $message
     * @param array|null $processInfo
     * @return array
     */
    public function responseBag(
        $data = null,
        ?bool $success = true,
        string $message = null,
        array $processInfo = null
    ): array {
        return [
            'data' => $data,
            'success' => $success,
            'message' => $message,
            'processo_info' => $processInfo
        ];
    }

    /**
     * @param array $list
     * @param int $count
     * @param bool|null $success
     * @param string|null $message
     * @param array|null $processInfo
     * @return array
     */
    public function responseBagForPaging(
        array $list,
        int $count,
        ?bool $success = true,
        string $message = null,
        array $processInfo = null
    ): array {
        return $this->responseBag([
            'list' => $list,
            'count' => $count
        ], true, $message, $processInfo);
    }

    /**
     * @param null $data
     * @param string|null $message
     * @return array
     */
    public function responseBagForPersist($data = null, string $message = null): array
    {
        return $this->responseBag([
            'id' => $data->getId()
        ], true, $message);
    }

    /**
     *
     * @param string $name
     * @return CommandBus
     */
    public function getServiceBus(string $name = self::COMMAND_BUS_TRANSACTIONAL): CommandBus
    {
        return $this->get($name);
    }
}