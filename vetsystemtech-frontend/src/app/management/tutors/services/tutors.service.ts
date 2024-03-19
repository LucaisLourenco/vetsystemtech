import {HttpClient} from '@angular/common/http';
import {Injectable} from '@angular/core';
import {delay, first, map, Observable} from 'rxjs';
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
  private readonly ROUTE_TUTOR_SHOW = '/tutors/?id=';

  constructor(private http: HttpClient) {
  }

  list(): Observable<Tutor[]> {
    return this.http.get<any>(`${this.API}${this.ROUTE_TUTORS}`).pipe(
      map(response => response.tutors)
    );
  }

  save(tutor: Partial<Tutor>) {
    if (tutor.id) {
      return this.update(tutor);
    }

    return this.store(tutor);
  }

  loadById(id: string) {
    return this.http.get<Tutor>(`${this.API}${this.ROUTE_TUTOR_SHOW}${id}`);
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
