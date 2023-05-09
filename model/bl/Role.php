<?php 
    class Role extends AbstractModel{
        private $roleName;
        private $roleCode;

        public function setRoleName($roleName){
            $this->roleName = $roleName;
        }

        public function getRoleName(){
            return $this->roleName;
        }

        public function setRoleCode($roleCode){
            $this->roleCode = $roleCode;
        }

        public function getRoleCode(){
            return $this->roleCode;
        }
    }
?>