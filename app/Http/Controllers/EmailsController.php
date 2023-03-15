<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\Servidor;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


class EmailsController extends Controller
{
    public function enviarEmailServidor(Request $request)
    {

        $listaCorreos = Servidor::JOIN("Encargo_Servidor", "Encargo_Servidor.IdServidor", "=", "Servidores.IdServidor")
            ->JOIN("Usuarios", "Usuarios.IdUsuario", "=", "Encargo_Servidor.IdEncargado")
            ->WHERE("Encargo_Servidor.Alertas", "=", 1)
            ->WHERE("Servidores.IdServidor", "=", $request->idservidor)
            ->SELECT("Usuarios.Correo")->pluck('Correo');

        $nombreServidor = Servidor::JOIN("Encargo_Servidor", "Encargo_Servidor.IdServidor", "=", "Servidores.IdServidor")
            ->JOIN("Usuarios", "Usuarios.IdUsuario", "=", "Encargo_Servidor.IdEncargado")
            ->WHERE("Encargo_Servidor.Alertas", "=", 1)
            ->WHERE("Servidores.IdServidor", "=", $request->idservidor)
            ->SELECT("Servidores.Nombre")->value('Nombre');


        $reglas = [
            'idservidor' => 'required|int',
            'asunto' => 'required|string',
            'mensaje' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            $mensaje = [
                'Mensaje' => "No pueden existir campos vacíos",
                'Error' => $validator->errors()->all()
            ];
            return response()->json($mensaje, 400);
        } else {
            try {
                $mail = new PHPMailer(true);
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "TLS";
                $mail->Host = "smtp.titan.email";
                $mail->Port = 587;
                $mail->Username = "prograv@spestechnical.com";
                $mail->Password = 'curso2023.';
                $mail->CharSet = 'UTF-8';
                $mail->SetFrom('prograv@spestechnical.com', 'GRUPO SPES');
                $mail->isHTML(true);
                $mail->Subject = $request->asunto;
                $mail->Body = "<h3>Asunto: " . $request->asunto . "</h3>
                <strong>Nombre del Servidor: " . $nombreServidor . "</strong>
                <h4><strong>Mensaje: </strong></h4>
                <h4>" . $request->mensaje . "</h4>";
                foreach ($listaCorreos as $destinatarios) {
                    $mail->addAddress($destinatarios);
                }
                $mail->send();
            } catch (Exception $e) {
                return back()->with('Error', 'Error al enviar los E-Mails.');
            }

            $mensaje = [
                'Respuesta del Servidor' => "200 OK",
                'Mensaje' => "E-Mails enviados correctamente.",
            ];

            return response()->json($mensaje, 200);
        }
    }

    public function enviarEmailServicio(Request $request)
    {

        $listaCorreos = Servicio::JOIN("Encargo_Servicio", "Encargo_Servicio.IdServicio", "=", "Servicios.IdServicio")
            ->JOIN("Usuarios", "Usuarios.IdUsuario", "=", "Encargo_Servicio.IdEncargado")
            ->WHERE("Encargo_Servicio.Alertas", "=", 1)
            ->WHERE("Servicios.IdServicio", "=", $request->idservicio)
            ->SELECT("Usuarios.Correo")->pluck('Correo');

        $nombreServicio =  Servicio::JOIN("Encargo_Servicio", "Encargo_Servicio.IdServicio", "=", "Servicios.IdServicio")
            ->JOIN("Usuarios", "Usuarios.IdUsuario", "=", "Encargo_Servicio.IdEncargado")
            ->WHERE("Encargo_Servicio.Alertas", "=", 1)
            ->WHERE("Servicios.IdServicio", "=", $request->idservicio)
            ->SELECT("Servicios.Nombre")->value('Nombre');

        $reglas = [
            'idservicio' => 'required|int',
            'asunto' => 'required|string',
            'mensaje' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            $mensaje = [
                'Mensaje' => "No pueden existir campos vacíos",
                'Error' => $validator->errors()->all()
            ];
            return response()->json($mensaje, 400);
        } else {
            try {
                $mail = new PHPMailer(true);
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "TLS";
                $mail->Host = "smtp.titan.email";
                $mail->Port = 587;
                $mail->Username = "prograv@spestechnical.com";
                $mail->Password = 'curso2023.';
                $mail->CharSet = 'UTF-8';
                $mail->SetFrom('prograv@spestechnical.com', 'GRUPO SPES');
                $mail->isHTML(true);
                $mail->Subject = $request->asunto;
                $mail->Body = "<h3>Asunto: " . $request->asunto . "</h3>
                <strong>Nombre del Servicio: " . $nombreServicio . "</strong>
                <h4><strong>Mensaje: </strong></h4>
                <h4>" . $request->mensaje . "</h4>";
                foreach ($listaCorreos as $destinatarios) {
                    $mail->addAddress($destinatarios);
                }
                $mail->send();
            } catch (Exception $e) {
                return back()->with('Error', 'Error al enviar los E-Mails.');
            }

            $mensaje = [
                'Respuesta del Servidor' => "200 OK",
                'Mensaje' => "E-Mails enviados correctamente.",
            ];

            return response()->json($mensaje, 200);
        }
    }
}
