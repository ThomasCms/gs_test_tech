import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Band } from '../models/band.model';

const baseUrl = 'http://localhost:8000';

@Injectable({
  providedIn: 'root'
})
export class BandService {

  constructor(private http: HttpClient) {
  }

  index(): Observable<Band[]> {
    return this.http.get<Band[]>(baseUrl);
  }

  get(id: number): Observable<Band> {
    return this.http.get<Band>(`${baseUrl}/${id}`);
  }

  create(data: Band): Observable<any> {
    return this.http.post(`${baseUrl}/create`, data);
  }

  update(id: number, data: any): Observable<any> {
    return this.http.put(`${baseUrl}/update/${id}`, data);
  }

  delete(id: number|undefined): Observable<any> {
    if (id === undefined) {
      console.error('Cannot remove undefined band.');
    }

    return this.http.delete(`${baseUrl}/delete/${id}`);
  }

  import(file: File): Observable<any> {
    const formData = new FormData();
    formData.append('file', file);

    return this.http.post(`${baseUrl}/import`, formData);
  }
}
