<?php
/* Icinga Web 2 | (c) 2013-2015 Icinga Development Team | GPLv2+ */

namespace Icinga\Module\Monitoring\Forms\Command;

use Icinga\Module\Monitoring\Backend\MonitoringBackend;
use Icinga\Module\Monitoring\Command\Transport\CommandTransport;
use Icinga\Web\Form;
use Icinga\Web\Request;

/**
 * Base class for command forms
 */
abstract class CommandForm extends Form
{
    /**
     * Monitoring backend
     *
     * @var MonitoringBackend
     */
    protected $backend;

    /**
     * Set the monitoring backend
     *
     * @param   MonitoringBackend $backend
     *
     * @return  $this
     */
    public function setBackend(MonitoringBackend $backend)
    {
        $this->backend = $backend;
        return $this;
    }

    /**
     * Get the monitoring backend
     *
     * @return MonitoringBackend
     */
    public function getBackend()
    {
        return $this->backend;
    }

    /**
     * Get the transport used to send commands
     *
     * @param   Request $request
     *
     * @return  \Icinga\Module\Monitoring\Command\Transport\CommandTransportInterface
     */
    public function getTransport(Request $request)
    {
        $transportName = $request->getParam('transport');
        if ($transportName !== null) {
            $transport = CommandTransport::create($transportName);
        } else {
            $transport = CommandTransport::first();
        }
        return $transport;
    }
}
