<?php

class Application_Model_Course
{
    protected $_course;
    protected $_dini;
    protected $_dfini;
    protected $_idcourses;

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
            throw new Exception('Invalid course property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid course property');
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

    public function setCourse($courses)
    {
        $this->_course = (string) $courses;
        return $this;
    }

    public function getCourse()
    {
        return $this->_course;
    }

    public function setDini($dini)
    {
        $this->_dini = (string) $dini;
        return $this;
    }

    public function getDini()
    {
        return $this->_dini;
    }

    public function setDfini($dfini)
    {
    	$this->_dfini = (string) $dfini;
    	return $this;
    }
    
    public function getDfini()
    {
    	return $this->_dfini;
    }

    public function setIdCourses($idcourse)
    {
        $this->_idcourses = (int) $idcourse;
        return $this;
    }

    public function getIdCourses()
    {
        return $this->_idcourses;
    }
}

