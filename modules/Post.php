<!-- <?php

// include_once "Common.php";

// class Post extends Common{

    // protected $pdo;

    // public function __construct(\PDO $pdo){
    //     $this->pdo = $pdo;
    // }

    // public function postStudents(){
    //     //code for retrieving data on DB
    //     return "This is some student records added.";
    // }

    // public function postClasses(){
    //     //code for retrieving data on DB
    //     return "This is some classes records added.";
    // }

    // public function postFaculty(){
    //     //code for retrieving data on DB
    //     return "This is some faculty records added.";
    // }


//     public function postChefs($body){
//       $result = $this->postData("chefs_tbl", $body, $this->pdo);
//       if($result['code'] == 200){
//         $this->logger("testthunder5", "POST", "Created a new chef record");
//         return $this->generateResponse($result['data'], "success", "Successfully created a new record.", $result['code']);
//       }
//       $this->logger("testthunder5", "POST", $result['errmsg']);
//       return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
//     }

//     public function postMenu($body){
//        $result = $this->postData("menu_tbl", $body, $this->pdo);
//        if($result['code'] == 200){
//         $this->logger("testthunder5", "POST", "Created a new menu record");
//         return $this->generateResponse($result['data'], "success", "Successfully created a new record.", $result['code']);
//       }
//       return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
//     }
// }

// ?> 