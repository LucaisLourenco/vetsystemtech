import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { first } from 'rxjs';
import {Tutor} from "../model/tutor";

@Injectable({
  providedIn: 'root'
})
export class TutorsService {

  private readonly API = 'api/tutors';

  constructor(private http: HttpClient) { }

  list() {
    return this.http.get<Tutor[]>(this.API).pipe(
      first(),
      //delay(5000),
      //tap(responsaveis => console.log(responsaveis))
    );
  }

  save(tutor: Partial<Tutor>) {
    if (tutor.id) {
      return this.update(tutor);
    }

    return this.store(tutor);
  }

  loadById(id: string) {
    return this.http.get<Tutor>(`${this.API}/$\{id}\`)`);
  }

  private store(tutor: Partial<Tutor>) {
    return this.http.post<Tutor>(this.API, tutor).pipe(first());
  }

  private update(tutor: Partial<Tutor>) {
    return this.http.put<Tutor>(`${this.API}/${tutor.id}`, tutor).pipe(first());
  }

  delete(cpf: string) {
    return this.http.delete(`${this.API}/${cpf}`).pipe(first());
  }
}
