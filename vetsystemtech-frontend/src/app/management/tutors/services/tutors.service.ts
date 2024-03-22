import {HttpClient} from '@angular/common/http';
import {Injectable} from '@angular/core';
import {first, map, Observable} from 'rxjs';
import {Tutor} from "../model/tutor";
import {tap} from "rxjs/operators";
import {environment} from "../../../../environments/environment.development";

@Injectable({
  providedIn: 'root'
})
export class TutorsService {

  private readonly API = environment.apiUrl;
  private readonly ROUTE_TUTORS = '/tutors';
  private readonly ROUTE_TUTOR_DELETE = '/tutors/destroy?id=';
  private readonly ROUTE_TUTOR_SHOW = '/tutors/';

  constructor(private http: HttpClient) {
  }

  list(): Observable<Tutor[]> {
    return this.http.get<any>(`${this.API}${this.ROUTE_TUTORS}`).pipe(
      map(response => response.data),
      tap(reponse => console.log(reponse))
    );
  }

  save(tutor: Partial<Tutor>) {
    if (tutor.id) {
      return this.update(tutor);
    }

    return this.store(tutor);
  }

  loadById(id: string) {
    const url = `${this.API}${this.ROUTE_TUTOR_SHOW}${id}`;
    return this.http.get<Tutor>(url).pipe(
      tap(tutor => console.log(url))
    );
  }

  private store(tutor: Partial<Tutor>) {
    return this.http.post<Tutor>(this.API, tutor).pipe(first());
  }

  private update(tutor: Partial<Tutor>) {
    return this.http.put<Tutor>(`${this.API}/${tutor.id}`, tutor).pipe(first());
  }

  delete(id: string) {
    return this.http.delete(`${this.API}${this.ROUTE_TUTOR_DELETE}${id}`).pipe(first());
  }
}
