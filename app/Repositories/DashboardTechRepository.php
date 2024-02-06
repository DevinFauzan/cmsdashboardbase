<?php

namespace App\Repositories;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Auth;

class DashboardTechRepository
{
    /**
     * Fetch all list of Tahun Pelajaran from database
     * 
     * @param  array   $columns
     * @param  int     $pageNumber
     * @param  int     $pageSize
     * @param  string  $orderColumn
     * @param  string  $orderDir
     * @return object
     */


     
     // DashboardTechRepository

     public function getAll(array $columns = ["*"], int $pageNumber, int $pageSize, string $orderColumn, string $orderDir, string $searchTerm = null)
     {
         $query = Ticket::query()
             ->join('users', 'tickets.user_id', '=', 'users.id') // Join users table
             ->orderBy($orderColumn, $orderDir)
             ->skip($pageNumber * $pageSize)
             ->take($pageSize);
     
         if ($searchTerm) {
             $query->where(function ($subquery) use ($searchTerm) {
                 $columns = ['users.name', 'tickets.name_user', 'tickets.subject', 'tickets.status', 'tickets.created_at', 'tickets.updated_at', 'tickets.ticket_id'];
     
                 foreach ($columns as $column) {
                     $subquery->orWhere($column, 'like', '%' . $searchTerm . '%');
                 }
             });
         }
     
         info('SQL Query: ' . $query->toSql());
     
         return $query->get($columns);
     }
     

     


    /**
     * Fetch a detail of Tahun Pelajaran
     * 
     * @param  int     $id
     * @return object
     */
    function get(int $id)
    {
        return Ticket::where('id', $id)->first();
    }

    /**
     * Fetch Tahun Pelajaran list by ticket ID
     * 
     * @param  array    $columns
     * @param  int      $TicketID
     * @return array
     */
    function getAllByTicketID(array $columns = ["*"], int $ticketID)
    {
        return Ticket::join('t_siswa_tahun_pelajaran', function ($join) {
            $join->on('t_siswa_tahun_pelajaran.tahun_pelajaran_id', '=', 't_tahun_pelajaran.id');
        })->where('t_siswa_tahun_pelajaran.siswa_id', $ticketID)->get($columns);
    }

    /**
     * Fetch the count of all data in Tahun Pelajaran
     * 
     * @return object
     */
    function getCount()
    {
        return Ticket::count();
    }

    /**
     * Creates a new instance of Tahun Pelajaran
     * 
     * @return array
     */
    function create(array $data)
    {
        return Ticket::create($data);
    }

    /**
     * Updates an instance of Tahun Pelajaran
     * 
     * @return array
     */
    function update(int $id, array $data)
    {
        return Ticket::where('id', $id)->update($data);
    }
}
