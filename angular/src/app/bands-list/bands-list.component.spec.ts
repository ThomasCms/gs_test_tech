import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BandsListComponent } from './bands-list.component';

describe('BandsListComponent', () => {
  let component: BandsListComponent;
  let fixture: ComponentFixture<BandsListComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [BandsListComponent]
    });
    fixture = TestBed.createComponent(BandsListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
