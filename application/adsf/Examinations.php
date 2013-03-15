<?php

class Application_Model_Examinations
{
    protected $idexaminations;
    protected $date;
    protected $courses_idcourses;
    protected $exams_idexams;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
	/**
	 * @return the $idexaminations
	 */
	public function getIdexaminations() {
		return $this->idexaminations;
	}

	/**
	 * @return the $date
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * @return the $courses_idcourses
	 */
	public function getCourses_idcourses() {
		return $this->courses_idcourses;
	}

	/**
	 * @return the $exams_idexams
	 */
	public function getExams_idexams() {
		return $this->exams_idexams;
	}

	/**
	 * @param field_type $idexaminations
	 */
	public function setIdexaminations($idexaminations) {
		$this->idexaminations = $idexaminations;
	}

	/**
	 * @param field_type $date
	 */
	public function setDate($date) {
		$this->date = $date;
	}

	/**
	 * @param field_type $courses_idcourses
	 */
	public function setCourses_idcourses($courses_idcourses) {
		$this->courses_idcourses = $courses_idcourses;
	}

	/**
	 * @param field_type $exams_idexams
	 */
	public function setExams_idexams($exams_idexams) {
		$this->exams_idexams = $exams_idexams;
	}

}

