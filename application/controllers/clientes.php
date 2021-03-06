<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends CI_Controller {
    
    public function __construct() {
        
        parent::__construct();
        
        $this->load->helper('url');
        
    }

    public function index(){
            
            $this->load->view('clientes');
                
        }
        
        public function alta(){
            
            $datos['nombre'] = $this->input->post('nombre_cliente');
            
            $datos['apellido_p'] = $this->input->post('apellido_p');
            
            $datos['apellido_m'] = $this->input->post('apellido_m');
            
            $datos['calle_numero'] = $this->input->post('calle_numero');
            
            $datos['colonia'] = $this->input->post('colonia');
            
            $datos['delegacion_municipio'] = $this->input->post('delegacion_municipio');
            
            $datos['codigo_postal'] = $this->input->post('codigo_postal');
            
            $datos['telefono_p'] = $this->input->post('telefono_particular');
            
            $datos['telefono_m'] = $this->input->post('telefono_movil');
            
            $datos['correo_e'] = $this->input->post('correo_e');
            
            $datos['rfc'] = $this->input->post('rfc');
            
            $this->load->model('clientes_model', 'c_m', TRUE);
            
            $alta = $this->c_m->alta($datos);
            
            if($alta == 1){
                
                echo 'El clientes ha sido dado de alta en la base de datos';
                
                redirect('/principal/index/clientes', 'refresh');
                
            } else {
                
                echo 'Ups! no pudimos dar de alta al cliente en la base de datos.';
                
            }
            
        }
        
        public function borrar(){
            
            $id_cliente = $this->input->post('id_cliente');
            
            $this->load->model('clientes_model', 'c_m', TRUE);
            
            $borrar = $this->c_m->borrar($id_cliente);
            
            echo $borrar;
            
        }
        
        public function buscar_clientes(){
            
            $apellido_p = $this->input->post('apellido_p');
            
            $this->load->model('clientes_model', 'c_m');
            
            $data['datos_cliente'] = $this->c_m->buscar_clientes($apellido_p);
            
            $data['title'] = 'Buscar Cliente';
            
            $data['footer'] = $this->load->view('barra_de_herramientas', '', TRUE);
            
            $data['head'] = $this->load->view('head', $data, TRUE);
            
            $this->load->view('lista_clientes', $data);
            
        }
        
        public function listado_clientes(){
            
            $this->load->model('clientes_model', 'c_m');
            
            $data['clientes'] = $this->c_m->listar_clientes();
            
            $data['title'] = 'Lista de clientes';
            
            $data['footer'] = $this->load->view('barra_de_herramientas', '', TRUE);
            
            $data['head'] = $this->load->view('head', $data, TRUE);
            
            $this->load->view('listado_clientes', $data);
            
        }
        
        public function editar_cliente($id_cliente){
            
            $datos['id_cliente'] = $id_cliente;
            
            $this->load->model('clientes_model', 'c_m', TRUE);
            
            echo $_POST['apellido_p'];
            
            foreach($_POST as $value => $key){
                
                $datos[$value] = $key;
                
            }
            
            print_r($datos);
            
            $this->c_m->editar($datos);
            
            echo 'Listo';
            
        }
        
        public function buscar_cliente($apellido_p, $id_venta){
            
            //$apellido_p = $this->input->post('apellido_p');
            
            $this->load->model('clientes_model', 'c_m', TRUE);
            
            $data['datos_cliente'] = $this->c_m->buscar_clientes($apellido_p);
            
            $this->load->model('ventas_model', 'v_m', TRUE);
            
            $this->v_m->agregar_cliente($data['datos_cliente']['id_cliente'], $id_venta);
            
            print_r(json_encode($data['datos_cliente']));
            
        }
                
}

/* End of file principal.php */
/* Location: ./application/controllers/principal.php */
