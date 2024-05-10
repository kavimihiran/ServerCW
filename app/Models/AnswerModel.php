<?php

namespace App\Models;

use CodeIgniter\Model;

class AnswerModel extends Model
{
    protected $table = 'answers';
    protected $allowedFields = ['answer_id', 'body', 'votes', 'isAccepted', 'postedAt', 'question_id'];

    public function getanswers($questionId)
    {
        $builder = $this->db->table('answers');
        $builder->select("question_id,body,answer_id,votes,isAccepted");
        $builder->where('question_id', $questionId);
        $result = $builder->get();
        $rows = $result->getResultArray();
        $row = $result->getRow();
        if ($row !== null && $row->question_id == $questionId) {
            return $rows;
        } else {
            return [];
        }
    }
    public function incrementVote($answerId)
    {
        $builder = $this->db->table('answers');
        $builder->where('answer_id', $answerId);
        $builder->set('votes', 'votes + 1', false); // Increment vote count by 1
        $builder->update();

        return $this->db->affectedRows() > 0;
    }

    public function decrementVote($answerId)
    {
        $builder = $this->db->table('answers');
        $builder->where('answer_id', $answerId);
        $builder->set('votes', 'votes - 1', false); // Decrement vote count by 1
        $builder->update();

        return $this->db->affectedRows() > 0;
    }
    public function answerMarked($answerId)
    {
        $builder = $this->db->table('answers');
        $builder->where('answer_id', $answerId);
        $builder->set('isAccepted', 1); // Decrement vote count by 1
        $builder->update();

        return $this->db->affectedRows() > 0;
    }
}
