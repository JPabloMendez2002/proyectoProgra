<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class EmailsController extends Controller
{
    public function enviarEmails(Request $request)
    {
        $reglas = [
            'asunto' => 'required|string',
            'mensaje' => 'required|string',
            'destinatario1' => 'required|email',
            'destinatario2' => 'required|email',
            'destinatario3' => 'required|email',
        ];

        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {

            $mensaje = [
                'Mensaje' => "No pueden existir campos vacíos",
                'Error' => $validator->errors()->all()
            ];
            return response()->json($mensaje);
        } else {
            try {
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "TLS";
                $mail->Host = "smtp.titan.email";
                $mail->Port = 587;
                $mail->Username = "prograv@spestechnical.com";
                $mail->Password = 'curso2023.';
                $mail->CharSet = 'UTF-8';
                $mail->SetFrom('prograv@spestechnical.com', 'GRUPO SPES');
                $mail->addAddress($request->destinatario1);
                $mail->addCC($request->destinatario2);
                $mail->addCC($request->destinatario3);
                $mail->isHTML(true);
                $mail->Subject = $request->asunto;
                $mail->Body = "<h2>Mensajes Proyecto</h2>
                <h3>Asunto: " . $request->asunto . "</h3>
                <h4><strong>Mensaje: </strong></h4>
                <h4>" . $request->mensaje . "</h4>";
                $mail->send();
            } catch (Exception $e) {
                return back()->with('Error', 'Error al enviar los E-Mails.');
            }

            $mensaje = [
                'Respuesta del Servidor' => "200 OK",
                'Mensaje' => "E-Mails enviados correctamente.",
            ];

            return response()->json($mensaje);
        }
    }
}
