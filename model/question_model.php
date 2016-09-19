<?php

declare(strict_types=1);

/**
 * Model for question data processing
 */
class Question_Model extends Main_Model
{
    /**
     * Question text
     * @var type string
     */
    private $value;
    
    public function showList(int $from = 0, int $to = 5): array
    {
        $query = $this->db->prepare("
            SELECT question_id, question_text, question_author 
            FROM questions 
            ORDER BY question_id ASC 
            LIMIT :from, :to
        ");
        
        $query->execute(array(':from' => $from, ':to' => $to));
        
        return $query->fetchAll();
    }
    
    /**
     * Save question in the database
     * @return type string
     */
    public function save(string $text): bool
    {
        $this->setQuestionValue($text);
        
        $query = $this->db->prepare("INSERT INTO questions (question_text) VALUES (:text)");
        $query->execute(array(':text' => $this->getQuestionValue()));
        
        $last_id = (int) $this->db->lastInsertId();
        
        return $last_id ? true : false;
    }
    
    /**
     * Remove question from the database
     * @param type $id
     */
    public function remove(): void
    {
        $query = $this->db->prepare("DELETE FROM questions WHERE id = :id");
        $query->execute(array(':id' => $this->getQuestionValue()));
    }
    
    /**
     * Get current question value
     * @return string
     */
    public function getQuestionValue(): string
    {
        return $this->value;
    }
    
    /**
     * Set current question value
     * @param string $text
     */
    private function setQuestionValue(string $text): void
    {
        $this->value = is_string($text) ? $text : null;
    }
}
