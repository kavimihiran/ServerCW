<?php

namespace App\Models;

use CodeIgniter\Model;

class QuestionModel extends Model
{
    protected $table = 'questions';
    protected $allowedFields = ['question_id', 'title', 'body', 'tags', 'votes', 'username', 'postedAt'];

    public function getQuestions($user)
    {
        $builder = $this->db->table('questions');
        $builder->select("question_id,username,title,body,votes");
        $builder->where('username', $user);
        $result = $builder->get();
        $rows = $result->getResultArray();
        $row = $result->getRow();
        if ($row !== null && $row->username == $user) {
            return $rows;
        } else {
            return [];
        }
    }
    public function updateQuestions($title, $body, $id)
    {
        $builder = $this->db->table('questions');
        $data = [
            'title' => $title,
            'body' => $body,
            'question_id' => $id,
        ];
        $builder->where('question_id', $id);
        $builder->update($data);
// Check if any rows were affected
        if ($this->db->affectedRows() > 0) {
            // Return true if update was successful
            return true;
        } else {
            // Return false if no rows were updated
            return false;
        }

    }
    public function getId($title, $body)
    {
        $builder = $this->db->table('questions');
        $builder->select("question_id,username,title,body");
        $builder->where('title', $title);
        $result = $builder->get();
        $row = $result->getRow();
        if ($row !== null && $row->title == $title) {
            return $row->question_id;
        } else {
            return [];
        }
    }
    public function incrementVote($questionId)
    {
        $builder = $this->db->table('questions');
        $builder->where('question_id', $questionId);
        $builder->set('votes', 'votes + 1', false); // Increment vote count by 1
        $builder->update();

        return $this->db->affectedRows() > 0;
    }

    public function decrementVote($questionId)
    {
        $builder = $this->db->table('questions');
        $builder->where('question_id', $questionId);
        $builder->set('votes', 'votes - 1', false); // Decrement vote count by 1
        $builder->update();

        return $this->db->affectedRows() > 0;
    }
    public function search($query)
    {
        $builder = $this->db->table($this->table);
        $builder->select('question_id, username, title, body, votes');
        $builder->like('tags', $query);
        return $builder->get()->getResultArray();

    }

}
