<?php

class ToDoTask
{
    public $id;
    public $title;
    public $description;
    public $completed;
    public $createdAt;

    public function __construct($title, $description = '')
    {
        $this->id = uniqid();
        $this->title = $title;
        $this->description = $description;
        $this->completed = false;
        $this->createdAt = date('Y-m-d H:i:s');
    }

    public function markComplete()
    {
        $this->completed = true;
    }

    public function markIncomplete()
    {
        $this->completed = false;
    }

    public function getStatus()
    {
        return $this->completed ? 'Completed' : 'Uncompleted';
    }
}
class ToDoList
{
    private $tasks = [];

    public function addTask(ToDoTask $task)
    {
        $this->tasks[$task->id] = $task;
    }

    public function removeTask($id)
    {
        if (!isset($this->tasks[$id])) {
            throw new InvalidArgumentException("Task with ID {$id} not found");
        }
        unset($this->tasks[$id]);
    }

    public function getTask($id)
    {
        return $this->tasks[$id] ?? null;
    }

    public function getAllTasks()
    {
        return array_values($this->tasks);
    }

    public function getAllCompletedTasks()
    {
        return array_filter($this->tasks, fn ($task) => true === $task->completed);
    }

    public function getAllUncompletedTasks()
    {
        return array_filter($this->tasks, fn ($task) => false === $task->completed);
    }

    public function markTaskCompleted($id)
    {
        if (!isset($this->tasks[$id])) {
            throw new InvalidArgumentException("Task with ID {$id} not found");
        }
        $this->tasks[$id]->markComplete();
    }

    public function getStatistic()
    {
        $completed = count($this->getAllCompletedTasks());
        $uncompleted = count($this->getAllUncompletedTasks());
        $total = count($this->tasks);

        return [
            'total' => $total,
            'completed' => $completed,
            'uncompleted' => $uncompleted,
            'completionRate' => $total > 0 ? ($completed / $total) * 100 : 0,
        ];
    }

    public function clearCompleted()
    {
        $this->tasks = array_filter($this->tasks, fn ($task) => false === $task->completed);
    }
}
