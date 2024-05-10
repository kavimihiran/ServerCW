<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentsModel extends Model
{
    protected $table = 'comments';
    protected $allowedFields = ['comment_id', 'body', 'postedAt', 'answer_id'];

    public function getcomments($answerId)
    {
        $builder = $this->db->table('comments');
        $builder->select("body,answer_id");
        $builder->where('answer_id', $answerId);
        $result = $builder->get();
        $rows = $result->getResultArray();
        $row = $result->getRow();
        if ($row !== null && $row->answer_id == $answerId) {
            return $rows;
        } else {
            return [];
        }
    }

}
