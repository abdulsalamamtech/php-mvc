<?php

class Sample{
    use Controller;

    // GET tasks index() tasks.index Show all tasks
    public function index(){

    }
    // GET tasks/create create() tasks.create Show the create task form
    // not necessary in API
    public function create(){

    }
    // POST tasks store() tasks.store Accept form submission
    //  from the create task form
    public function store(){

    }
    // GET tasks/{task} show() tasks.show Show one task
    public function show($id){

    }
    // GET tasks/ {task}/edit edit() tasks.edit Edit one task
    // not necessary in API
    public function edit($id){

    }
    // PUT/PATCH tasks/{task} update() tasks.update Accept form 
    // submission from the edit taskform
    public function update($id){

    }
    // DELETE tasks/{task} destroy() tasks.destroy Delete one task
    public function destroy($id){

    }


}