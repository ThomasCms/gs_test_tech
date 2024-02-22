
import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BandsUpdateComponent } from './bands-update.component';

describe('BandsUpdateComponent', () => {
  let component: BandsUpdateComponent;
  let fixture: ComponentFixture<BandsUpdateComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [BandsUpdateComponent]
    });
    fixture = TestBed.createComponent(BandsUpdateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
