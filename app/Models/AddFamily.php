<?php
    namespace App\Models;

    use App\Models\Parentus;
    use App\Models\Children;
    use App\Model;

class AddFamily extends Model
{
    public function __construct(protected Parentus $parentModel, protected Children $childrenModel){
        parent::__construct();
    }

    public function add(array $parentInfo, array $childrenInfo): void{
        try{
            $this->db->beginTransaction();
            
            $parnetId = $this->parentModel->create($parentInfo['name'], $parentInfo['surname']);
            $this->childrenModel->create($childrenInfo['children'], $parnetId);
            
            $this->db->commit();
        } catch (\Throwable $e){
            if($this->db->inTransaction()){
                $this->db->rollback();
            }
            throw $e;
        }
    }

    public function updateFamily(array $parentInfo, array $childrenInfo): void {
        try{
            $this->db->beginTransaction();
            
            $this->parentModel->updateParent($parentInfo['id'], $parentInfo['name'], $parentInfo['surname']);
            $this->childrenModel->updateChildren($childrenInfo, $parentInfo['id']);
            
            $this->db->commit();
        } catch (\Throwable $e){
            if($this->db->inTransaction()){
                $this->db->rollback();
            }
            throw $e;
        }
    }

    public function deleteFamily(array $parentInfo, array $childrenInfo): void {
        try{
            $this->db->beginTransaction();
            
            $this->childrenModel->deleteChildren($parentInfo['id']);
            $this->parentModel->deleteParent($parentInfo['id']);
            
            $this->db->commit();
        } catch (\Throwable $e){
            if($this->db->inTransaction()){
                $this->db->rollback();
            }
            throw $e;
        }
    }
    
}