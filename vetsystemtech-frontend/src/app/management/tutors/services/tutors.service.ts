import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import {delay, first} from 'rxjs';
import {Tutor} from "../model/tutor";
import {tap} from "rxjs/operators";
import {environment} from "../../../../environments/environment.development";

@Injectable({
  providedIn: 'root'
})
export class TutorsService {

  private readonly API = environment.apiUrlTutors;

  constructor(private http: HttpClient) { }

  list() {
    console.log( this.http.get<Tutor[]>(this.API));
    return this.http.get<Tutor[]>(this.API).pipe(
      tap(tutors => console.log(tutors))
    );
  }

  save(tutor: Partial<Tutor>) {
    if (tutor.cpf) {
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
    return this.http.put<Tutor>(`${this.API}/${tutor.cpf}`, tutor).pipe(first());
  }

  delete(cpf: string) {
    return this.http.delete(`${this.API}/${cpf}`).pipe(first());
  }
}
