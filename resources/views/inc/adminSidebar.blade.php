<div class="accordion" id="accordionVocab">
    <div>
      <div id="word">
        <h4>
          <div  data-toggle="collapse" data-target="#collapseWord" aria-expanded="true" aria-controls="collapseWord">
            Word
          </div>
        </h4>
      </div>
  
      <div id="collapseWord" class="collapse pl-5" aria-labelledby="word" data-parent="#accordionVocab">
            <a class="d-block text-secondary p-1" href=" {{route('adminWord')}}">All Word</a>
            <a class="d-block text-secondary p-1" href=" {{route('words.create')}}">Create Word</a>
      
      </div>
    </div>
    <hr>
    <div>
        <div id="category">
          <h4>
            <div  data-toggle="collapse" data-target="#collapseCategory" aria-expanded="true" aria-controls="collapseCategory">
             Category
            </div>
          </h4>
        </div>
    
        <div id="collapseCategory" class="collapse pl-5" aria-labelledby="category" data-parent="#accordionVocab">
            
            <a class="d-block text-secondary p-1" href=" {{route('dashboard')}}">All Category</a>              
            
            <a class="d-block text-secondary p-1" href=" {{route('categories.create')}}">Create Category</a>

        </div>
      </div>

 
  </div>