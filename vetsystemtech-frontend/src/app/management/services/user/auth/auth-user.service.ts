import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {Observable, throwError} from 'rxjs';
import {catchError, tap} from 'rxjs/operators';
import jwt_decode from 'jwt-decode';
import {environment} from 'src/environments/environment.development';

@Injectable({
  providedIn: 'root',
})
export class AuthUserService {

  apiUrl = environment.apiUrl;

  constructor(private httpClient: HttpClient) {
  }

  login(username: string, password: string): Observable<any> {
    return this.httpClient
      .post<any>(`${this.apiUrl}/user/login`, {username: username, password: password})
      .pipe(
        tap((response) => {
          localStorage.setItem('userToken', response.token); // Armazena o token JWT no localStorage
        }),
        catchError(this.handleError)
      );
  }

  // Função para fazer o logout do usuário
  logout() {
    localStorage.removeItem('userToken'); // Remove o token JWT do localStorage
    return new Observable(observer => {
      observer.next(); // Notifica o sucesso do logoff
      observer.complete(); // Completa o Observable
    });
  }

  // Função para verificar se o usuário está autenticado
  isAuthenticated(): boolean {
    const token = localStorage.getItem('userToken'); // Recupera o token JWT do localStorage
    if (token) {
      const decoded = jwt_decode(token) as any; // Decodifica o token JWT
      const current_time = new Date().getTime() / 1000; // Converte a data atual para segundos
      if (decoded.exp < current_time) {
        // Verifica se o token JWT expirou
        localStorage.removeItem('userToken'); // Remove o token JWT do localStorage
        return false;
      }
      return true;
    }
    return false;
  }

  // Função para obter o token JWT
  getToken(): string | null {
    return localStorage.getItem('userToken') ?? null; // Retorna o token JWT do localStorage
  }

  // Função para lidar com os erros da requisição
  private handleError(error: any): Observable<never> {
    let errorMessage = 'Ocorreu um erro desconhecido!';

    // Verifica se o erro é do tipo HttpErrorResponse
    if (error.error instanceof ErrorEvent) {
      // Erro no cliente
      errorMessage = `Error: ${error.error.message}`;
    } else {
      // Erro no servidor
      if (error.status === 401) {
        // Erro de autenticação
        localStorage.removeItem('userToken'); // Remove o token JWT do localStorage
        errorMessage = 'Nome de usuário ou senha inválidos.';
      } else if (error.status === 403) {
        // Erro de autorização
        localStorage.removeItem('userToken'); // Remove o token JWT do localStorage
        errorMessage = 'Acesso negado!';
      } else {
        errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`;
      }
    }

    return throwError(errorMessage); // Retorna um observable com o erro
  }
}
