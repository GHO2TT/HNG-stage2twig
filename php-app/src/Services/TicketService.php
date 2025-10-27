<?php
// php-app/src/Services/TicketService.php

namespace App\Services;

class TicketService
{
    private $ticketsFile;
    
    public function __construct()
    {
        $dataPath = __DIR__ . '/../../data';
        if (!file_exists($dataPath)) {
            mkdir($dataPath, 0777, true);
        }
        $this->ticketsFile = $dataPath . '/tickets.json';
        
        if (!file_exists($this->ticketsFile)) {
            file_put_contents($this->ticketsFile, json_encode([]));
        }
    }
    
    private function getTickets()
    {
        $content = file_get_contents($this->ticketsFile);
        return json_decode($content, true) ?: [];
    }
    
    private function saveTickets($tickets)
    {
        file_put_contents($this->ticketsFile, json_encode($tickets, JSON_PRETTY_PRINT));
    }
    
    public function getAllTickets()
    {
        return $this->getTickets();
    }
    
    public function createTicket($data)
    {
        $tickets = $this->getTickets();
        
        $newTicket = [
            'id' => (string)time() . rand(1000, 9999),
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'] ?? 'open',
            'priority' => $data['priority'] ?? 'medium',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $tickets[] = $newTicket;
        $this->saveTickets($tickets);
        
        return $newTicket;
    }
    
    public function updateTicket($id, $data)
    {
        $tickets = $this->getTickets();
        
        foreach ($tickets as &$ticket) {
            if ($ticket['id'] === $id) {
                $ticket['title'] = $data['title'];
                $ticket['description'] = $data['description'];
                $ticket['status'] = $data['status'];
                $ticket['priority'] = $data['priority'];
                $ticket['updated_at'] = date('Y-m-d H:i:s');
                break;
            }
        }
        
        $this->saveTickets($tickets);
    }
    
    public function deleteTicket($id)
    {
        $tickets = $this->getTickets();
        $tickets = array_filter($tickets, function($ticket) use ($id) {
            return $ticket['id'] !== $id;
        });
        
        $this->saveTickets(array_values($tickets));
    }
    
    public function getTicketById($id)
    {
        $tickets = $this->getTickets();
        
        foreach ($tickets as $ticket) {
            if ($ticket['id'] === $id) {
                return $ticket;
            }
        }
        
        return null;
    }
    
    public function getStats()
    {
        $tickets = $this->getTickets();
        
        return [
            'total' => count($tickets),
            'open' => count(array_filter($tickets, fn($t) => $t['status'] === 'open')),
            'in_progress' => count(array_filter($tickets, fn($t) => $t['status'] === 'in_progress')),
            'closed' => count(array_filter($tickets, fn($t) => $t['status'] === 'closed'))
        ];
    }
}
