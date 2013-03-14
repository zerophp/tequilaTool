<?php

class Application_Model_DbTable_Questions extends Zend_Db_Table_Abstract
{
    protected $_name = 'questions';

    public function getQuestion($idquestions)
    {
        $idquestions = (int)$idquestions;
        $row = $this->fetchRow('idquestions = ' . $idquestions);
        if (!$row) {
        throw new Exception("Could not find row $idquestions");
        }
        return $row->toArray();
    }
    
    
    
    public function addQuestion($question, $answer1,$answer2,$answer3,$answer4,$answer5,$solution,$answers_types_idanswers_types,$exams_idexams)
    {
        $data = array(
            'question' => $question,
            'answer1' => $answer1,
            'answer2' => $answer2,
            'answer3' => $answer3,
            'answer4' => $answer4,
            'answer5' => $answer5,
            'solution' => $solution,
            'answers_types_idanswers_types' => $answers_types_idanswers_types,
            'exams_idexams' => $exams_idexams,
        );
        
        $this->insert($data);
    }
    
    public function updateQuestion($idquestions, $question, $answer1,$answer2,$answer3,$answer4,$answer5,$solution,$answers_types_idanswers_types,$exams_idexams)
    {
        $data = array(
            'question' => $question,
            'answer1' => $answer1,
            'answer2' => $answer2,
            'answer3' => $answer3,
            'answer4' => $answer4,
            'answer5' => $answer5,
            'solution' => solution,
            'answers_types_idanswers_types' => $answers_types_idanswers_types,
             'exams_idexams' => $exams_idexams,
        );
        $this->update($data, 'idquestions = '. (int)$idquestions);
    }
    
    public function deleteQuestion($idquestions)
    {
        $this->delete('idquestions =' . (int)$idquestions);
    }
    
    public function selectOptionsExams()
    {
            
        $sql = "select idexams, name from exams order by name";
        $db = Zend_Registry::get('db');
        $result = $db->fetchPairs($sql);
        
//         		echo '<pre>';
//         		print_r($result);
//         		echo '<pre>';
//         		die;
        
        
        return $result;
    }
}
