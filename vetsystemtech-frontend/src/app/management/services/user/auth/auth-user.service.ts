import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {Observable, throwError} from 'rxjs';
import {catchError, tap} from 'rxjs/operators';
import jwt_decode from 'jwt-decode';
import {environment} from 'src/environments/environment.development';
import {AppRoutes} from "../../../shared/app-routes";
import {TOKEN_USER} from "../../../utils/constants";
import {USER_MESSAGES} from "../../../shared/messages/user-messages";

@Injectable({
  providedIn: 'root',
})
export class AuthUserService {

  apiUrl = environment.apiUrl;

  constructor(private httpClient: HttpClient) {
  }

  login(username: string, password: string): Observable<any> {
    return this.httpClient
      .post<any>(`${this.apiUrl}${AppRoutes.LOGIN}`, {username: username, password: password})
      .pipe(
        tap((response) => {
          localStorage.setItem(TOKEN_USER, response);
        }),
        catchError(this.handleError)
      );
  }

  logout() {
    localStorage.removeItem(TOKEN_USER);
    return new Observable(observer => {
      observer.next();
      observer.complete();
    });
  }

  isAuthenticated(): boolean {
    const token = localStorage.getItem(TOKEN_USER);
    if (token) {
      const decoded = jwt_decode(token) as any;
      const current_time = new Date().getTime() / 1000;
      if (decoded.exp < current_time) {
        localStorage.removeItem(TOKEN_USER);
        return false;
      }
      return true;
    }
    return false;
  }

  getToken(): string | null {
    return localStorage.getItem(TOKEN_USER) ?? null;
  }

  private handleError(error: any): Observable<never> {
    let errorMessage;

    if (error.error instanceof ErrorEvent) {
      errorMessage = `${error.error.message}`;
    } else {
      if (error.status === 401) {
        localStorage.removeItem(TOKEN_USER);
        errorMessage = USER_MESSAGES.LOGIN_FAILED;
      } else if (error.status === 403) {
        localStorage.removeItem(TOKEN_USER);
        errorMessage = USER_MESSAGES.ACESSO_NEGADO;
      } else {
        errorMessage = `${error.message}`;
      }
    }

    return throwError(errorMessage);
  }
}
